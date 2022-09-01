<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Models\CommunityModel;
use Src\Code\Requests\CommunityEditPictureRequest;
use Src\Code\Requests\CommunityEditNameRequest;
use Src\Code\Requests\CommunityEditDescriptionRequest;

class CommunityEditController extends Controller
{
    /**
     * @var CommunityModel
     */
    private CommunityModel $comModel;

    /**
     * @var CommunityEditPictureRequest
     */
    private CommunityEditPictureRequest $editPic;

    /**
     * @var CommunityEditNameRequest
     */
    private CommunityEditNameRequest $editName;

    /**
     * @var CommunityEditDescriptionRequest
     */
    private CommunityEditDescriptionRequest $editDesc;

    /**
     * @var ModeratorController
     */
    private ModeratorController $modCon;

    /**
     * @var CommunityController
     */
    private CommunityController $comCon;

    public function __construct()
    {
        parent::__construct();
        $this->comModel = new CommunityModel();
        $this->editPic = new CommunityEditPictureRequest();
        $this->editName = new CommunityEditNameRequest();
        $this->editDesc = new CommunityEditDescriptionRequest();
        $this->modCon = new ModeratorController();
        $this->comCon = new CommunityController();
    }

    /**
     * @param Request $req
     * @return void
     */
    public function setCommunityPicture(Request $req): void
    {
        $data = $req->validateInput();
        $id = $this->comCon->getId($data['comunidade']);
        if ($id) {
            if ($this->editPic->validateForm($data)) {
                if ($this->modCon->checkUserModeratesCommunity(session(LOG_U), $id)) {
                    $picture = $this->comCon->getCommunityPicture($id);
                    $this->deleteFile($picture);
                    $uploadedFile = $this->createFile($data['arquivoEditarFoto'], session(LOG_U));
                    $this->moveFile($data['arquivoEditarFoto'], $uploadedFile);
                    $this->comModel->update(['community_picture' => $uploadedFile])
                        ->where(['id' => $id])
                        ->executeQuery();
                    echo 'Foto editada';
                } else {
                    echo 'Erro';
                }
            } else {
                print_r($this->editPic->getErrors());
            }
        } else {
            echo 'Erro';
        }
    }

    /**
     * @param Request $req
     * @return void
     */
    public function setName(Request $req): void
    {
        $data = $req->validateInput();
        $id = $this->comCon->getId($data['comunidade']);
        if ($id) {
            if ($this->editName->validateForm($data)) {
                if ($this->modCon->checkUserModeratesCommunity(session(LOG_U), $id)) {
                    $this->comModel->update(['name' => $data['inputEditarNome']])
                        ->where(['id' => $id])
                        ->executeQuery();
                    echo 'Nome editado';
                } else {
                    echo 'Erro';
                }
            } else {
                print_r($this->editName->getErrors());
            }
        } else {
            echo 'Erro';
        }
    }

    /**
     * @param Request $req
     * @return void
     */
    public function setDescription(Request $req): void
    {
        $data = $req->validateInput();
        $id = $this->comCon->getId($data['comunidade']);
        if ($id) {
            if ($this->editDesc->validateForm($data)) {
                if ($this->modCon->checkUserModeratesCommunity(session(LOG_U), $id)) {
                    $this->comModel->update(['description' => $data['txtaEditarDescricao']])
                        ->where(['id' => $id])
                        ->executeQuery();
                    echo 'Descrição editada';
                } else {
                    echo 'Erro';
                }
            } else {
                print_r($this->editDesc->getErrors());
            }
        } else {
            echo 'Erro';
        }
    }

    /**
     * @param int $id
     * @param int $value
     * @return void
     */
    public function setSubscribers(int $id, int $value): void
    {
        $this->comModel->update(['subscribers' => $value])
            ->where(['id' => $id])
            ->executeQuery();
    }

    /**
     * @param int $id
     * @param int $value
     * @return void
     */
    public function setTopics(int $id, int $value): void
    {
        $this->comModel->update(['topics' => $value])
            ->where(['id' => $id])
            ->executeQuery();
    }
}