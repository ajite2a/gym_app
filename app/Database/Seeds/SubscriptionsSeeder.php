<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubscriptionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id'    => 1,
                'plan_id'    => 2,
                'start_date' => date('Y-m-d'),
                'end_date'   => date('Y-m-d', strtotime('+30 days')),
                'status'     => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'    => 2,
                'plan_id'    => 3,
                'start_date' => date('Y-m-d', strtotime('-10 days')),
                'end_date'   => date('Y-m-d', strtotime('+80 days')),
                'status'     => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'    => 3,
                'plan_id'    => 4,
                'start_date' => date('Y-m-d', strtotime('-5 days')),
                'end_date'   => date('Y-m-d', strtotime('+360 days')),
                'status'     => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('subscriptions')->insertBatch($data);
    }
}
