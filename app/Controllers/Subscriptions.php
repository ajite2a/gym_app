<?php

namespace App\Controllers;

use App\Models\SubscriptionModel;
use App\Models\UserModel;
use App\Models\PlanModel;

class Subscriptions extends BaseController
{
    protected $subscriptionModel;
    protected $userModel;
    protected $planModel;

    public function __construct()
    {
        $this->subscriptionModel = new SubscriptionModel();
        $this->userModel = new UserModel();
        $this->planModel = new PlanModel();
        helper(['url', 'form']);
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $subscriptions = $this->subscriptionModel->getSubscriptionsWithDetails();

        return view('Subscriptions/index', [
            'subscriptions' => $subscriptions,
        ]);
    }

    public function form($id = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $subscription = null;
        $action = 'create';

        if ($id) {
            $subscription = $this->subscriptionModel->find($id);
            if (!$subscription) {
                return redirect()->route('subscriptions')->with('error', 'Subscription not found.');
            }
            $action = 'edit';
        }

        if ($this->request->getMethod() === 'POST') {
            $isEdit = (bool)$id;
            $rules = [
                'user_id'    => 'required|integer',
                'plan_id'    => 'required|integer',
                'start_date' => 'required|valid_date',
                'end_date'   => 'required|valid_date',
                'status'     => 'required|in_list[active,inactive,expired,cancelled]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $data = [
                'user_id'    => $this->request->getPost('user_id'),
                'plan_id'    => $this->request->getPost('plan_id'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date'   => $this->request->getPost('end_date'),
                'status'     => $this->request->getPost('status'),
            ];

            if ($isEdit) {
                $this->subscriptionModel->update($id, $data);
                return redirect()->route('subscriptions')->with('success', 'Subscription updated successfully.');
            } else {
                $this->subscriptionModel->insert($data);
                return redirect()->route('subscriptions')->with('success', 'Subscription created successfully.');
            }
        }

        $users = $this->userModel->findAll();
        $plans = $this->planModel->findAll();

        return view('Subscriptions/form', [
            'subscription' => $subscription,
            'action'       => $action,
            'users'        => $users,
            'plans'        => $plans,
        ]);
    }

    public function delete($id = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $subscription = $this->subscriptionModel->find($id);
        if (!$subscription) {
            return redirect()->route('subscriptions')->with('error', 'Subscription not found.');
        }

        $this->subscriptionModel->delete($id);
        return redirect()->route('subscriptions')->with('success', 'Subscription deleted successfully.');
    }
}
