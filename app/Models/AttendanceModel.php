<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['user_id', 'attendance_date', 'check_in_time', 'check_out_time', 'status', 'notes'];

    // Validation Rules
    protected $validationRules = [
        'user_id' => 'required|integer',
        'attendance_date' => 'required|valid_date',
        'check_in_time' => 'permit_empty|string',
        'check_out_time' => 'permit_empty|string',
        'status' => 'required|in_list[present,absent,late,early_leave]',
        'notes' => 'permit_empty|string',
    ];

    protected $validationMessages = [
        'user_id' => [
            'required' => 'Member is required',
            'integer' => 'Invalid member selected',
        ],
        'attendance_date' => [
            'required' => 'Attendance date is required',
            'valid_date' => 'Please enter a valid date',
        ],
        'check_in_time' => [
            'string' => 'Please enter a valid check-in time',
        ],
        'check_out_time' => [
            'string' => 'Please enter a valid check-out time',
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list' => 'Please select a valid status',
        ],
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';

    /**
     * Get attendance with user details
     */
    public function getAttendanceWithDetails($id = null)
    {
        $this->select('attendance.*, users.name, users.email, users.profile_picture')
            ->join('users', 'users.id = attendance.user_id', 'left');

        if ($id !== null) {
            return $this->find($id);
        }

        return $this->findAll();
    }

    /**
     * Get all attendance records with user details (for list view)
     */
    public function getAllAttendanceWithDetails()
    {
        return $this->select('attendance.*, users.name, users.email, users.profile_picture')
            ->join('users', 'users.id = attendance.user_id', 'left')
            ->orderBy('attendance.attendance_date', 'DESC')
            ->findAll();
    }

    /**
     * Get attendance by date range
     */
    public function getAttendanceByDateRange($startDate, $endDate)
    {
        return $this->select('attendance.*, users.name, users.email, users.profile_picture')
            ->join('users', 'users.id = attendance.user_id', 'left')
            ->where('attendance.attendance_date >=', $startDate)
            ->where('attendance.attendance_date <=', $endDate)
            ->orderBy('attendance.attendance_date', 'DESC')
            ->findAll();
    }

    /**
     * Get attendance by user
     */
    public function getAttendanceByUser($userId)
    {
        return $this->select('attendance.*, users.name, users.email')
            ->join('users', 'users.id = attendance.user_id', 'left')
            ->where('attendance.user_id', $userId)
            ->orderBy('attendance.attendance_date', 'DESC')
            ->findAll();
    }

    /**
     * Get today's attendance
     */
    public function getTodayAttendance()
    {
        $today = date('Y-m-d');
        return $this->select('attendance.*, users.name, users.email, users.profile_picture')
            ->join('users', 'users.id = attendance.user_id', 'left')
            ->where('attendance.attendance_date', $today)
            ->orderBy('attendance.check_in_time', 'DESC')
            ->findAll();
    }
}
