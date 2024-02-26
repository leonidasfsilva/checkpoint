<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Users extends Migration
{
    protected string $tableName = 'users';

    public function __construct(?Forge $forge = null)
    {
        parent::__construct($forge);
    }

    public function up()
    {
        $fields = [
            'id'            => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'name'          => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'email'         => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'cpf'           => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'password'      => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'id_permission' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'created_at'    => [
                'type'    => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at'    => [
                'type'    => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            ],
            'active'        => [
                'type'       => 'TINYINT',
                'constraint' => 4,
                'default'    => '1',
            ],
            'status'        => [
                'type'       => 'TINYINT',
                'constraint' => 4,
                'default'    => '1',
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id', 'id');
        $this->forge->createTable($this->tableName, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName, true);
    }
}
