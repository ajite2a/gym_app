<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'profile_picture',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'joined_at',
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
        'name'      => 'required|string|max_length[255]',
        'email'     => 'required|valid_email|max_length[255]',
        'password'  => 'required|min_length[6]|max_length[255]',
        'phone'     => 'permit_empty|numeric|max_length[20]',
        'address'   => 'permit_empty|max_length[1000]',
        'gender'    => 'permit_empty|in_list[male,female,other]',
        'status'    => 'required|in_list[active,inactive]',
    ];

    protected $validationMessages = [
        'name'      => [
            'required'      => 'Name is required.',
            'max_length'    => 'Name must not exceed 255 characters.',
        ],
        'email'     => [
            'required'      => 'Email is required.',
            'valid_email'   => 'Please enter a valid email address.',
            'max_length'    => 'Email must not exceed 255 characters.',
        ],
        'password'  => [
            'required'      => 'Password is required.',
            'min_length'    => 'Password must be at least 6 characters.',
            'max_length'    => 'Password must not exceed 255 characters.',
        ],
        'confirm_password' => [
            'required'      => 'Confirm password is required.',
            'min_length'    => 'Confirm password must be at least 6 characters.',
            'max_length'    => 'Confirm password must not exceed 255 characters.',
            'matches'       => 'Confirm password must match the password.',
        ],
        'profile_picture' => [
            'is_image'      => 'Profile picture must be a valid image file.',
            'max_size'      => 'Profile picture must not exceed 5MB.',
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

    public function getUsersByRole($role)
    {
        return $this->where('role', $role)->findAll();
    }

    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
