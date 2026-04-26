<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PlansSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'              => 'Basic Plan',
                'price'             => 29.99,
                'duration'          => 30,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'name'              => 'Premium Plan',
                'price'             => 59.99,
                'duration'          => 90,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'name'              => 'Elite Plan',
                'price'             => 129.99,
                'duration'          => 365,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'name'              => 'Day Pass',
                'price'             => 9.99,
                'duration'          => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('plans')->insertBatch($data);
    }
}

