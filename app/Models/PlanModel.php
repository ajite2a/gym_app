<?php

namespace App\Models;

use CodeIgniter\Model;

class PlanModel extends Model
{
    protected $table            = 'plans';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['name', 'price', 'duration', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'name'      => 'required|string|max_length[255]',
        'price'     => 'required|numeric|greater_than[0]',
        'duration'  => 'required|integer|greater_than[0]',
    ];

    protected $validationMessages = [
        'name'      => [
            'required'      => 'Plan name is required.',
            'max_length'    => 'Plan name must not exceed 255 characters.',
        ],
        'price'     => [
            'required'      => 'Price is required.',
            'numeric'       => 'Price must be a valid number.',
            'greater_than'  => 'Price must be greater than 0.',
        ],
        'duration'  => [
            'required'      => 'Duration is required.',
            'integer'       => 'Duration must be a whole number.',
            'greater_than'  => 'Duration must be greater than 0.',
        ],
    ];
}
