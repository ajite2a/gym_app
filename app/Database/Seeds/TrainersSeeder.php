<?php

namespace Database\Seeders;

use CodeIgniter\Database\Seeder;

class TrainersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'     => 'John Smith',
                'email'    => 'john@example.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
                'role'     => 'trainer',
                'status'   => 'active',
                'phone'    => '555-1001',
                'gender'   => 'male',
                'address'  => '123 Main St, City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'     => 'Sarah Johnson',
                'email'    => 'sarah@example.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
                'role'     => 'trainer',
                'status'   => 'active',
                'phone'    => '555-1002',
                'gender'   => 'female',
                'address'  => '456 Oak Ave, City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'     => 'Mike Davis',
                'email'    => 'mike@example.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
                'role'     => 'trainer',
                'status'   => 'active',
                'phone'    => '555-1003',
                'gender'   => 'male',
                'address'  => '789 Pine Rd, City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
