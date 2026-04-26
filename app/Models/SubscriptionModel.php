<?php

namespace App\Models;

use CodeIgniter\Model;

class SubscriptionModel extends Model
{
    protected $table            = 'subscriptions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'plan_id',
        'start_date',
        'end_date',
        'status',
        'created_at',
        'updated_at',
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'user_id'    => 'required|integer',
        'plan_id'    => 'required|integer',
        'start_date' => 'required|valid_date',
        'end_date'   => 'required|valid_date',
        'status'     => 'required|in_list[active,inactive,expired,cancelled]',
    ];

    protected $validationMessages = [
        'user_id'    => [
            'required' => 'User is required.',
            'integer'  => 'User must be a valid user.',
        ],
        'plan_id'    => [
            'required' => 'Plan is required.',
            'integer'  => 'Plan must be a valid plan.',
        ],
        'start_date' => [
            'required'  => 'Start date is required.',
            'valid_date' => 'Please enter a valid start date.',
        ],
        'end_date'   => [
            'required'  => 'End date is required.',
            'valid_date' => 'Please enter a valid end date.',
        ],
        'status'     => [
            'required' => 'Status is required.',
            'in_list'  => 'Status must be active, inactive, expired, or cancelled.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getSubscriptionsWithDetails()
    {
        return $this->select('subscriptions.*, users.name as user_name, users.email as user_email, plans.name as plan_name, plans.price as plan_price, plans.duration as plan_duration')
                    ->join('users', 'users.id = subscriptions.user_id')
                    ->join('plans', 'plans.id = subscriptions.plan_id')
                    ->findAll();
    }

    public function getSubscriptionWithDetails($id)
    {
        return $this->select('subscriptions.*, users.name as user_name, users.email as user_email, plans.name as plan_name, plans.price as plan_price, plans.duration as plan_duration')
                    ->join('users', 'users.id = subscriptions.user_id')
                    ->join('plans', 'plans.id = subscriptions.plan_id')
                    ->where('subscriptions.id', $id)
                    ->first();
    }
}
