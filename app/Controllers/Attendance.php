<?php

namespace App\Controllers;

use App\Models\AttendanceModel;
use App\Models\UserModel;

class Attendance extends BaseController
{
    protected $attendanceModel;
    protected $userModel;

    public function __construct()
    {
        $this->attendanceModel = new AttendanceModel();
        $this->userModel = new UserModel();
        helper(['url', 'form']);
    }

    /**
     * Display list of attendance records
     */
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to(route_to('login'));
        }

        $data = [
            'title' => 'Attendance Records',
            'attendance' => $this->attendanceModel->getAllAttendanceWithDetails(),
        ];

        return view('Attendance/index', $data);
    }

    /**
     * Unified form method for create and edit
     */
    public function form($id = null)
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to(route_to('login'));
        }

        $attendance = [];
        $action = 'create';
        $title = 'Record Attendance';

        if ($id !== null) {
            $attendance = $this->attendanceModel->find($id);
            if (!$attendance) {
                session()->setFlashdata('error', 'Attendance record not found');
                return redirect()->to(route_to('attendance'));
            }
            $action = 'update';
            $title = 'Edit Attendance Record';
        }

        if ($this->request->getMethod() === 'POST') {
            $isEdit = (bool)$id;

            // Set validation rules
            $rules = [
                'user_id' => 'required|integer',
                'attendance_date' => 'required|valid_date',
                'check_in_time' => 'permit_empty|string',
                'check_out_time' => 'permit_empty|string',
                'status' => 'required|in_list[present,absent,late,early_leave]',
                'notes' => 'permit_empty|string',
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }

            $data = [
                'user_id' => $this->request->getPost('user_id'),
                'attendance_date' => $this->request->getPost('attendance_date'),
                'check_in_time' => $this->request->getPost('check_in_time') ?: null,
                'check_out_time' => $this->request->getPost('check_out_time') ?: null,
                'status' => $this->request->getPost('status'),
                'notes' => $this->request->getPost('notes'),
            ];

            if ($isEdit) {
                $this->attendanceModel->update($id, $data);
                session()->setFlashdata('success', 'Attendance record updated successfully');
            } else {
                $this->attendanceModel->insert($data);
                session()->setFlashdata('success', 'Attendance record created successfully');
            }

            return redirect()->to(route_to('attendance'));
        }

        $data = [
            'title' => $title,
            'action' => $action,
            'attendance' => $attendance,
            'members' => $this->userModel->where('role', 'member')->where('status', 'active')->findAll(),
        ];

        return view('Attendance/form', $data);
    }

    /**
     * Delete attendance record
     */
    public function delete($id = null)
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to(route_to('login'));
        }

        if ($id === null) {
            session()->setFlashdata('error', 'Invalid attendance record');
            return redirect()->to(route_to('attendance'));
        }

        $attendance = $this->attendanceModel->find($id);

        if (!$attendance) {
            session()->setFlashdata('error', 'Attendance record not found');
            return redirect()->to(route_to('attendance'));
        }

        $this->attendanceModel->delete($id);
        session()->setFlashdata('success', 'Attendance record deleted successfully');

        return redirect()->to(route_to('attendance'));
    }
}
