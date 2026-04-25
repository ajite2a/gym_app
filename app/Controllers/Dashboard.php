<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    /**
     * Show dashboard
     */
    public function index()
    {
        // Check if user is logged in
        if (!session()->has('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $data = [
            'title'       => 'Dashboard',
            'user_name'   => session()->get('name'),
            'user_email'  => session()->get('email'),
        ];

        return view('layouts/main', $data);
    }
}
