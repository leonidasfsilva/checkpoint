<?php

namespace App\Models;

use App\Exceptions\CpfAlreadyRegisteredException;
use App\Exceptions\EmailAlreadyRegisteredException;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class CheckpointModel extends Model
{
    protected $table            = 'checkpoints';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'id_checkpoint_type',
        'status',
    ];
    protected $builder;
    protected $db;

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'checkpoint_time';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [
        'verifyTodaysCheckpoints',
    ];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        $this->db      = db_connect();
        $this->builder = $this->db->table($this->table);

    }

    protected function verifyTodaysCheckpoints(array $data)
    {
        $todayDate = date('Y-m-d');
        $startDate = sprintf('%s 00:00:00', $todayDate);
        $endDate   = sprintf('%s 23:59:59', $todayDate);

        $this->builder->orderBy('checkpoint_time', 'DESC');
        $todaysCheckpoints = $this->builder->getWhere([
            'id_user'            => $data['data']['id_user'],
            'checkpoint_time >=' => $startDate,
            'checkpoint_time <=' => $endDate,
            'status'             => 1,
        ])->getRow() ?? null;

        if ($todaysCheckpoints) {
            $checkpointType = $todaysCheckpoints->id_checkpoint_type + 1;

            if ($todaysCheckpoints->id_checkpoint_type == 4) {
                return $data;
            }

            $data['data']['id_checkpoint_type'] = $checkpointType;
        }

        return $data;
    }

    public function getCheckpointsByUser(int $idUser)
    {
        $checkpointsList = $this->builder
            // ->select('c.*, ct.label, ct.description')
            ->from([], true)
            ->from('checkpoints c')
            ->where(
                [
                    'c.id_user' => $idUser,
                    'c.status'  => 1,
                ]
            )
            ->join('checkpoint_types ct', 'ct.id = c.id_checkpoint_type', 'left')
            ->get()
            ->getResult() ?? null;

        if ($checkpointsList) {
            return $checkpointsList;
        }
        return false;
    }

    public function getCheckpointDetails(int $idCheckpoint)
    {
        $checkpointObj = $this->builder->where([
            'id'     => $idCheckpoint,
            'status' => 1,
        ])->get()->getRow() ?? null;

        if ($checkpointObj) {
            return $checkpointObj;
        }
        return false;
    }

    public function getCheckpointType(int $idCheckpointType)
    {
        $builder           = $this->db->table('checkpoint_types');
        $checkpointTypeObj = $builder->where([
            'id'     => $idCheckpointType,
            'status' => 1,
        ])->get()->getRow() ?? null;

        if ($checkpointTypeObj) {
            return $checkpointTypeObj;
        }
        return false;
    }

    public function add(array $data)
    {
        $this->builder->insert($data);

        if ($this->builder->affectedRows() == '1') {
            return true;
        }

        return false;
    }
}
