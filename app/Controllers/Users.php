<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Exceptions\CpfAlreadyRegisteredException;
use App\Exceptions\EmailAlreadyRegisteredException;
use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        parent::__construct();

        header('Access-Control-Allow-Origin: ' . base_url());
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type');

        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!$this->authenticatedUser) {
            return redirect()->to('app/login');
        }

        return redirect()->to('app');
    }

    public function register()
    {
        // if ($this->authenticatedUser) {
        //     return redirect()->to('app');
        // }

        $data                = [
            'appName'         => 'CheckPoint',
            'userName'        => $this->userSession['userName'] ?? null,
            'isAuthenticated' => $this->authenticatedUser
        ];
        $data['mainContent'] = 'login/register';

        return view('theme/login/template', $data);
    }

    public function store()
    {
        if (!$this->request->getPost()) return redirect()->to('users/register');

        if (!$this->validateRegisterRequest()) {
            return redirect()->to('users/register')->withInput()->with('validationErrors', $this->validator->listErrors());
        }

        try {
            $request = $this->request->getPost();

            $data = [
                'name'     => $request['name'],
                'email'    => $request['email'],
                'password' => $request['password'],
                'cpf'      => !empty($request['cpf']) ? $request['cpf'] : null,
            ];

            $this->userModel->insert($data);
        } catch (EmailAlreadyRegisteredException $e) {
            session()->setFlashdata('error', 'Já existe uma conta associada ao email informado.');
            return redirect()->to('users/register');
        } catch (CpfAlreadyRegisteredException $e) {
            session()->setFlashdata('error', 'Já existe uma conta associada ao cpf informado.');
            return redirect()->to('users/register');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Erro ao tentar realizar cadastro.');
            return redirect()->to('users/register');
        }

        session()->setFlashdata('success', 'Cadastro realizado com sucesso!<br>Acesse sua conta.');
        return redirect()->to('app/login');
    }

    public function checkLogin()
    {
        if (!$this->request->getPost()) return redirect()->to('app/login');

        if (!$this->validateLoginRequest()) {
            return redirect()->to('app/login')->withInput()->with('validationErrors', $this->validator->listErrors());
        }

        $request  = $this->request->getPost();
        $email    = $request['email'] ?? null;
        $password = $request['password'] ?? null;

        if ((!$user = $this->retrieveUserInfo($email)) || (!$this->validateUserPassword($email, $password))) {
            session()->setFlashdata('error', 'Dados de acesso inválidos, por favor tente novamente.');
            return redirect()->to('app/login');
        }

        session()->set('userdata', [
            'isAuthenticated' => true,
            'userName'        => $user->name ?? null,
            'userEmail'       => $user->email ?? null,
            'userCpf'         => $user->cpf ?? null,
        ]);

        return redirect()->to('app/home');
    }

    protected function validateLoginRequest()
    {
        $rules = [
            'password' => 'required|max_length[255]|min_length[6]',
            'email'    => 'required|max_length[100]|valid_email',
        ];

        $messagesRules = [
            'password' => [
                'required'   => 'O campo Senha é obrigatório.',
                'min_length' => 'A senha deve conter no mínimo 6 caracteres.',
                'max_length' => 'A senha deve conter no máximo 255 caracteres.',
            ],
            'email'    => [
                'required'    => 'O campo email é obrigatório.',
                'valid_email' => 'Informe um email válido.',
                'max_length'  => 'O campo email deve conter no máximo 100 caracteres.',
            ],
        ];

        if (!$this->validate($rules, $messagesRules)) {
            return false;
        }
        return true;
    }

    protected function validateRegisterRequest()
    {
        $rules = [
            'name'     => 'required|max_length[100]',
            'password' => 'required|max_length[255]|min_length[6]',
            'cpf'      => 'permit_empty|min_length[14]|max_length[14]',
            'email'    => 'required|max_length[100]|valid_email',
        ];

        $messagesRules = [
            'name'     => [
                'required'   => 'O campo nome é obrigatório.',
                'max_length' => 'O campo nome deve conter no máximo 100 caracteres.',
            ],
            'password' => [
                'required'   => 'O campo senha é obrigatório.',
                'max_length' => 'O campo senha deve conter no máximo 255 caracteres.',
                'min_length' => 'O campo senha deve conter no mínimo 6 caracteres.',
            ],
            'cpf'      => [
                'min_length' => 'O campo CPF deve conter 11 dígitos.',
                'max_length' => 'O campo CPF deve conter 11 dígitos.',
            ],
            'email'    => [
                'required'    => 'O campo email é obrigatório.',
                'valid_email' => 'Informe um email válido.',
                'max_length'  => 'O campo email deve conter no máximo 100 caracteres.',
            ],
        ];

        if (!$this->validate($rules, $messagesRules)) {
            return false;
        }
        return true;
    }

    protected function retrieveUserInfo(string $email)
    {
        if (!$email) return false;

        if (!$userInfo = $this->userModel->getUserInfoByEmail($email)) return false;

        return $userInfo;
    }

    protected function validateUserPassword(string $email, string $password)
    {
        if (!$email || !$password) return false;

        if (!$this->userModel->validateUserPassword($email, $password)) return false;

        return true;
    }


}
