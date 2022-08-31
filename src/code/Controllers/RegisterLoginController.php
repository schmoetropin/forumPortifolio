<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Requests\RegisterRequest;
use Src\Code\Models\UserModel;

class RegisterLoginController extends Controller
{
    /**
     * @var UserModel
     */
    private UserModel $regModel;

    /**
     * @var RegisterRequest
     */
    private RegisterRequest $regReq;
    
    public function __construct()
    {
        parent::__construct();
        $this->regModel = new UserModel();
        $this->regReq = new RegisterRequest();
    }
    
    /**
     * @param Request 
     * @return void
     */
    public function register(Request $request): void
    {
        $data = $request->validateInput();
        if ($this->regReq->validateForm($data)) {
            $date = date('Y-m-d');
            $uniqueName = $this->createUniqueName($data['regNome'], $this->regModel->tableName());
            $profilePic = IMG.'fotoPerfilPadrao.png';
            $this->regModel->insert([
                'name' => $data['regNome'], 
                'unique_name' => $uniqueName, 
                'email' => $data['regEmail'], 
                'profile_pic' => $profilePic, 
                'password' => $data['regSenha'], 
                'created_at' => $date 
            ]);
            echo 'Novo usuário registrado';
        } else {
            print_r($this->regReq->getErrors());
        }
    }

    /**
     * @param Request $req
     * @return void
     */
    public function login(Request $req): void
    {
        $data = $req->validateInput();
        $this->regModel->select(['id'])
            ->where([
                'email' => $data['logEmail'],
                'password' => $data['logSenha']
            ]);
        if ($this->regModel->getRowCount() > 0) {
            $this->regModel->select(['id'])
            ->where([
                'email' => $data['logEmail'],
                'password' => $data['logSenha']
            ]);
            $log = $this->regModel->getDbData()[0]['id'];
            $this->setSession(LOG_U, $log);
            echo 'User found';
        } else {
            echo 'Usuario não encontrado';
        }
    }

    /**
     * @param Request $req
     * @return void
     */
    public function logout(Request $req): void
    {
        $this->unsetSession(LOG_U);
    }
}