<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CiSessions extends Migration
{
    protected string $tableName = 'ci_session';

    public function __construct(?Forge $forge = null)
    {
        parent::__construct($forge);
    }

    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'VARCHAR', 'constraint' => 128, 'null' => false],
            'ip_address' => ['type' => 'VARCHAR', 'constraint' => 45, 'null' => false],
            'timestamp timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL',
            'data'       => ['type' => 'BLOB', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('timestamp');
        $this->forge->createTable($this->tableName, true);

    }

    public function down()
    {
        $this->forge->dropTable($this->tableName, true);
    }
}
