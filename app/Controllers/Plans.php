<?php

namespace App\Controllers;

use App\Models\PlanModel;

class Plans extends BaseController
{
    protected $planModel;

    public function __construct()
    {
        $this->planModel = new PlanModel();
    }

    public function index()
    {
        if (!session()->has('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $data = [
            'title'  => 'Plans',
            'plans'  => $this->planModel->findAll(),
            'user_name'   => session()->get('name'),
            'user_email'  => session()->get('email'),
        ];

        return view('Plans/index', $data);
    }

    public function form($id = null)
    {
        if (!session()->has('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        helper(['form']);
        $validation = null;
        $plan = null;

        if ($id) {
            $plan = $this->planModel->find($id);
            if (!$plan) {
                return redirect()->route('plans')->with('error', 'Plan not found.');
            }
        }

        if ($this->request->getMethod() === 'POST') {
            $isEdit = (bool)$id;
            $rules = [
                'name' => 'required|min_length[2]|max_length[255]' . ($isEdit ? '|is_unique[plans.name,id,' . $id . ']' : '|is_unique[plans.name]'),
                'price' => 'required|numeric|greater_than[0]',
                'duration' => 'required|integer|greater_than[0]'
            ];

            if (!$this->validate($rules)) {
                $validation = \Config\Services::validation();
            } else {
                $data = [
                    'name' => $this->request->getPost('name'),
                    'price' => $this->request->getPost('price'),
                    'duration' => $this->request->getPost('duration'),
                ];

                if ($id) {
                    $this->planModel->update($id, $data);
                    $message = 'Plan updated successfully!';
                } else {
                    $this->planModel->insert($data);
                    $message = 'Plan created successfully!';
                }

                return redirect()->route('plans')->with('success', $message);
            }
        }

        $title = $id ? 'Edit Plan' : 'Add New Plan';
        $action = $id ? 'update' : 'create';

        $data = [
            'title' => $title,
            'action' => $action,
            'plan' => $plan,
            'validation' => $validation,
            'user_name' => session()->get('name'),
            'user_email' => session()->get('email'),
        ];

        return view('Plans/form', $data);
    }

    public function delete($id)
    {
        if (!session()->has('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $plan = $this->planModel->find($id);
        if (!$plan) {
            return redirect()->route('plans')->with('error', 'Plan not found.');
        }

        $this->planModel->delete($id);
        return redirect()->route('plans')->with('success', 'Plan deleted successfully!');
    }
}
