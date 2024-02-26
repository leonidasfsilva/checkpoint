<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CheckpointTypes extends Migration
{
    protected string $tableName = 'checkpoint_types';

    public function __construct(?Forge $forge = null)
    {
        parent::__construct($forge);
    }

    public function up()
    {
        $fields = [
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'label'       => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at'  => [
                'type'    => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at'  => [
                'type'    => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            ],
            'status'      => [
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
