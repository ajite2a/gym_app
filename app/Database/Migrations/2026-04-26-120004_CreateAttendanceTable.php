<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAttendanceTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'attendance_date' => [
                'type' => 'DATE',
            ],
            'check_in_time' => [
                'type'   => 'TIME',
                'null'   => true,
            ],
            'check_out_time' => [
                'type'   => 'TIME',
                'null'   => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['present', 'absent', 'late', 'early_leave'],
                'default'    => 'present',
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('attendance');
    }

    public function down()
    {
        $this->forge->dropTable('attendance');
    }
}
