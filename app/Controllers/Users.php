<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['url', 'form']);
    }

    public function index($role = 'trainer')
    {
        if (!session()->has('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        if (!in_array($role, ['trainer', 'member'])) {
            $role = 'trainer';
        }

        $data = [
            'title'  => ucfirst($role) . 's',
            'role'   => $role,
            'users'  => $this->userModel->getUsersByRole($role),
            'user_name'   => session()->get('name'),
            'user_email'  => session()->get('email'),
        ];

        return view('Users/index', $data);
    }

    public function form($role = 'trainer', $id = null)
    {
        if (!session()->has('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        if (!in_array($role, ['trainer', 'member'])) {
            $role = 'trainer';
        }

        $validation = null;
        $user = null;

        if ($id) {
            $user = $this->userModel->find($id);
            if (!$user || $user['role'] !== $role) {
                return redirect()->route('users', [$role])->with('error', ucfirst($role) . ' not found.');
            }
        }

        if ($this->request->getMethod() === 'POST') {
            $isEdit = (bool)$id;
            $rules = [
                'name' => 'required|min_length[2]|max_length[255]',
                'email' => 'required|valid_email|max_length[255]' . ($isEdit ? '|is_unique[users.email,id,' . $id . ']' : '|is_unique[users.email]'),
                'phone' => 'permit_empty|numeric|max_length[20]',
                'status' => 'required|in_list[active,inactive]',
            ];

            if (!$isEdit) {
                $rules['password'] = 'required|min_length[6]|max_length[255]';
                $rules['confirm_password'] = 'required|min_length[6]|max_length[255]|matches[password]';
            }

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
            } else {
                $data = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'phone' => $this->request->getPost('phone') ?? null,
                    'status' => $this->request->getPost('status'),
                    'address' => $this->request->getPost('address') ?? null,
                    'gender' => $this->request->getPost('gender') ?? null,
                ];

                if (!$isEdit) {
                    $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
                    $data['role'] = $role;
                }

                if ($id) {
                    $this->userModel->update($id, $data);
                    $message = ucfirst($role) . ' updated successfully!';
                } else {
                    $this->userModel->insert($data);
                    $message = ucfirst($role) . ' created successfully!';
                }

                return redirect()->route('users', [$role])->with('success', $message);
            }
        }

        $title = $id ? 'Edit ' . ucfirst($role) : 'Add New ' . ucfirst($role);
        $action = $id ? 'update' : 'create';

        $data = [
            'title' => $title,
            'action' => $action,
            'role' => $role,
            'user' => $user,
            'validation' => $validation,
            'user_name' => session()->get('name'),
            'user_email' => session()->get('email'),
        ];

        return view('Users/form', $data);
    }

    public function delete($role = 'trainer', $id = null)
    {
        if (!session()->has('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        if (!$id || !in_array($role, ['trainer', 'member'])) {
            return redirect()->route('users', [$role])->with('error', 'Invalid request.');
        }

        $user = $this->userModel->find($id);
        if (!$user || $user['role'] !== $role) {
            return redirect()->route('users', [$role])->with('error', ucfirst($role) . ' not found.');
        }

        $this->userModel->delete($id);
        return redirect()->route('users', [$role])->with('success', ucfirst($role) . ' deleted successfully!');
    }
}
