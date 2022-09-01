<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Models\UserModel;
use Src\Code\Requests\UserEditEmailRequest;
use Src\Code\Requests\UserEditNameRequest;
use Src\Code\Requests\UserEditPasswordRequest;
use Src\Code\Requests\UserEditPictureRequest;

class UserEditController extends Controller
{
    /**
     * @var UserModel
     */
    private UserModel $usModel;

    /**
     * @var UserController
     */
    private UserController $usCon;

    /**
     * @var UserEditEmailRequest
     */
    private UserEditEmailRequest $edEmail;

    /**
     * @var UserEditNameRequest
     */
    private UserEditNameRequest $edName;

    /**
     * @var UserEditPasswordRequest
     */
    private UserEditPasswordRequest $edPass;

    /**
     * @var UserEditPictureRequest
     */
    private UserEditPictureRequest $edPic;

    public function __construct()
    {
        parent::__construct();
        $this->usModel = new UserModel();
        $this->usCon = new UserController();
        $this->edEmail = new UserEditEmailRequest();
        $this->edName = new UserEditNameRequest();
        $this->edPass = new UserEditPasswordRequest();
        $this->edPic = new UserEditPictureRequest();
    }

    /**
     * @param Request $req
     * @return void
     */
    public function setName(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->edName->validateForm($data)) {
            $usId = $this->usCon->getId($data['usuario']);
            if (session(LOG_U) === $usId) {
                $this->usModel->update(['name' => $data['trocarNome']])
                    ->where(['id' => $usId])
                    ->executeQuery();
            }
        }
    }

    public function setEmail(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->edEmail->validateForm($data)) {
            $usId = $this->usCon->getId($data['usuario']);
            if (session(LOG_U) === $usId) {
                $this->usModel->update(['email' => $data['trocarEmail']])
                    ->where(['id' => $usId])
                    ->executeQuery();
            }
        }
    }

    public function setProfilePic(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->edPic->validateForm($data)) {
            $usId = $this->usCon->getId($data['usuario']);
            if (session(LOG_U) === $usId) {
                $oldProfilePic = $this->usCon->getProfilePic($usId);
                if ($oldProfilePic !== IMG.'fotoPerfilPadrao.png') {
                    $this->deleteFile($oldProfilePic);
                }
                $file = $this->createFile($data['trocarFotoPerfil'], $usId);
                $this->moveFile($data['trocarFotoPerfil'], $file);
                $this->usModel->update(['profile_pic' => UPLOAD.$file])
                    ->where(['id' => $usId])
                    ->executeQuery();
            }
        }
    }

    public function setPassword(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->edPass->validateForm($data)) {
            $usId = $this->usCon->getId($data['usuario']);
            if (session(LOG_U) === $usId) {
                $this->usModel->update(['password' => $data['trocarSenha']])
                    ->where(['id' => $usId])
                    ->executeQuery();
            }
        }
    }
}