<?php

namespace App\Controllers;

use App\Models\UserModel;

class Settings extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['url', 'form']);
    }

    /**
     * Display settings page
     */
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to(route_to('login'));
        }

        $userId = session()->get('id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->setFlashdata('error', 'User not found');
            return redirect()->to(route_to('dashboard'));
        }

        $data = [
            'title' => 'Settings',
            'user' => $user,
        ];

        return view('Settings/index', $data);
    }

    /**
     * Handle password reset
     */
    public function resetPassword()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to(route_to('login'));
        }

        if ($this->request->getMethod() !== 'POST') {
            return redirect()->to(route_to('settings'));
        }

        $userId = session()->get('id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->setFlashdata('error', 'User not found');
            return redirect()->to(route_to('settings'));
        }

        // Validation rules
        $rules = [
            'current_password' => 'required|min_length[6]',
            'new_password' => 'required|min_length[6]|max_length[255]',
            'confirm_password' => 'required|matches[new_password]',
        ];

        $messages = [
            'current_password' => [
                'required' => 'Current password is required',
                'min_length' => 'Current password must be at least 6 characters',
            ],
            'new_password' => [
                'required' => 'New password is required',
                'min_length' => 'New password must be at least 6 characters',
                'max_length' => 'New password cannot exceed 255 characters',
            ],
            'confirm_password' => [
                'required' => 'Confirm password is required',
                'matches' => 'Password confirmation does not match new password',
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');

        // Verify current password
        if (!password_verify($currentPassword, $user['password'])) {
            session()->setFlashdata('error', 'Current password is incorrect');
            return redirect()->back()->withInput();
        }

        // Update password
        $this->userModel->update($userId, [
            'password' => password_hash($newPassword, PASSWORD_BCRYPT),
        ]);

        session()->setFlashdata('success', 'Password changed successfully');
        return redirect()->to(route_to('settings'));
    }
}
