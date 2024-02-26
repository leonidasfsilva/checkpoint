<?php

namespace App\Models;

use App\Exceptions\CpfAlreadyRegisteredException;
use App\Exceptions\EmailAlreadyRegisteredException;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'password',
        'cpf',
    ];
    protected $builder;
    protected $db;

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
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
        'hashPassword',
        'verifyCpfAlreadyRegistered',
        'verifyEmailAlreadyRegistered',
    ];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // public function __construct()
    // {
    //     $this->db      = db_connect();
    //     $this->builder = $this->db->table($this->table);
    // }

    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        $this->db      = db_connect();
        $this->builder = $this->db->table($this->table);

    }

    protected function hashPassword(array $data): array
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }

    protected function verifyEmailAlreadyRegistered(array $data)
    {
        $this->builder->where('email', $data['data']['email']);
        $this->builder->where('status', 1);

        if ($this->builder->countAllResults() != 0) {
            throw new EmailAlreadyRegisteredException();
        }

        return $data;
    }

    protected function verifyCpfAlreadyRegistered(array $data)
    {
        if (isset($data['data']['cpf'])) {
            $this->builder->where('cpf', $data['data']['cpf']);
            $this->builder->where('status', 1);

            if ($this->builder->countAllResults() != 0) {
                throw new CpfAlreadyRegisteredException();
            }
        }

        return $data;
    }

    public function add(array $data)
    {
        $this->builder->insert($data);

        if ($this->builder->affectedRows() == '1') {
            return true;
        }

        return false;
    }

    public function getUserInfoByEmail(string $email)
    {
        if (empty($email)) return false;

        $user = $this->builder->getWhere([
            'email'  => $email,
            'active' => 1,
            'status' => 1,
        ])->getResult()[0] ?? null;

        if (!$user) return false;

        return $user;
    }

    public function validateUserPassword(string $email, string $password)
    {
        if (empty($email) || empty($password)) return false;

        $user = $this->builder->getWhere(['email' => $email])->getResult()[0] ?? null;

        if (!$user) return false;

        if (!password_verify($password, $user->password)) return false;

        return true;
    }
}
