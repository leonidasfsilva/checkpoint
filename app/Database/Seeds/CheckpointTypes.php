<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CheckpointTypes extends Seeder
{
    protected string $tableName = 'checkpoint_types';

    public function run()
    {
        $db      = db_connect();
        $results = $db->query(sprintf('select * from %s', $this->tableName))->getResult();

        if ($results) return;

        $dataList = [
            [
                'label'       => 'ENTRADA',
                'description' => 'Registra o início do expediente do colaborador',
            ],
            [
                'label'       => 'PAUSA ALMOÇO',
                'description' => 'Registra o início do horário de almoço',
            ],
            [
                'label'       => 'RETORNO ALMOÇO',
                'description' => 'Registra o término do horário de almoço',
            ],
            [
                'label'       => 'SAÍDA',
                'description' => 'Registra o término do expediente do colaborador',
            ],
        ];

        foreach ($dataList as $data) {
            $this->db->table($this->tableName)->insert($data);
        }
    }
}
