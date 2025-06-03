<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserModel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 256,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 256,
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 256,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 256,
            ],
            'role' => [
                'type'       => 'INT',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 256,
            ],
            'image' => [
                'type'       => 'TEXT',
            ],
            'create_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => false
            ],
        ]);
        
        $this->forge->addKey('id', true); // Khóa chính
        $this->forge->createTable('users');
        
    }


    public function down()
    {
        $this->forge->dropTable('users');
    }
}
