<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Exceptions\CpfAlreadyRegisteredException;
use App\Exceptions\EmailAlreadyRegisteredException;
use App\Models\CheckpointModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class App extends BaseController
{
    protected $userModel;
    protected $checkpointModel;

    public function __construct()
    {
        parent::__construct();

        header('Access-Control-Allow-Origin: ' . base_url());
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Access');
        $this->userModel       = new UserModel();
        $this->checkpointModel = new CheckpointModel();
    }

    public function index()
    {
        return redirect()->to('app/home');
    }

    public function home()
    {
        if ((!session_id()) || (!$this->authenticatedUser)) {
            return redirect()->to('app/login');
        }

        $data = [
            'appName'         => 'CheckPoint',
            'userName'        => $this->userSession['userName'] ?? null,
            'checkpointsList' => $this->getUserCheckpointsList() ?? null,
        ];

        $data['mainContent'] = 'app/home';;
        return view('theme/app/template', $data);
    }

    public function login()
    {
        if ($this->authenticatedUser) {
            return redirect()->to('app');
        }

        $data = [
            'appName'         => 'CheckPoint',
            'isAuthenticated' => $this->authenticatedUser
        ];

        $data['mainContent'] = 'login/login';

        return view('theme/login/template', $data);
    }

    public function logoff()
    {
        session()->destroy();
        return redirect()->to('app/login');
    }

    public function registerCheckpoint()
    {
        if ((!session_id()) || (!$this->authenticatedUser)) {
            return redirect()->to('app/login');
        }

        try {
            if (!$userInfo = $this->userModel->getUserInfoByEmail(session()->get('userdata')['userEmail'])) {
                session()->setFlashdata('error', 'Erro ao tentar realizar marcação do ponto.');
                return redirect()->to('app/home');
            }

            $data = [
                'id_user'            => $userInfo->id,
                'id_checkpoint_type' => 1,
            ];

            $insertedId = $this->checkpointModel->insert($data);
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Erro ao tentar realizar marcação de ponto.');
            return redirect()->to('app/home');
        }

        $checkpointDetails = $this->checkpointModel->getCheckpointDetails($insertedId);
        $checkpointType    = $this->checkpointModel->getCheckpointType($checkpointDetails->id_checkpoint_type);

        session()->setFlashdata('success', sprintf('Marcação realizada com sucesso!<br><b>%s</b>', $checkpointType->label));
        return redirect()->to('app/home');
    }

    public function getUserCheckpointsList()
    {
        if ((!session_id()) || (!$this->authenticatedUser)) {
            return redirect()->to('app/login');
        }

        try {
            if (!$userInfo = $this->userModel->getUserInfoByEmail(session()->get('userdata')['userEmail'])) {
                session()->setFlashdata('error', 'Erro ao tentar obter lista de marcações do usuário.');
                return redirect()->to('app/home');
            }

            $checkpointsList = $this->checkpointModel->getCheckpointsByUser($userInfo->id);

            if (!$checkpointsList) return false;

        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Erro ao tentar obter lista de marcações do usuário.');
            return redirect()->to('app/home');
        }

        return $checkpointsList;
    }

}
