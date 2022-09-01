<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Models\TopicModel;
use Src\Code\Requests\TopicEditContentRequest;
use Src\Code\Requests\TopicEditMediaRequest;
use Src\Code\Requests\TopicEditNameRequest;

class TopicEditController extends Controller
{
    /**
     * @var TopicModel
     */
    private TopicModel $topModel;

    /**
     * @var CommunityController
     */
    private CommunityController $comCon;

    /**
     * @var TopicController
     */
    private TopicController $topCon;

    /**
     * @var ModeratorController
     */
    private ModeratorController $modCon;

    /**
     * @var TopicEditContentRequest
     */
    private TopicEditContentRequest $topEdCon;
    
    /**
     * @var TopicEditMediaRequest
     */
    private TopicEditMediaRequest $topEdMed;

    /**
     * @var TopicEditNameRequest
     */
    private TopicEditNameRequest $topEdNam;

    public function __construct()
    {
        parent::__construct();
        $this->topModel = new TopicModel();
        $this->comCon = new CommunityController();
        $this->topCon = new TopicController();
        $this->modCon = new ModeratorController();
        $this->topEdCon = new TopicEditContentRequest();
        $this->topEdMed = new TopicEditMediaRequest();
        $this->topEdNam = new TopicEditNameRequest();
    }

    public function setName(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->topEdNam->validateForm($data)) {
            $topId = $this->topCon->getId($data['topPagId']);
            $comId = $this->topCon->getInCommunity($topId);
            $createdBy = $this->topCon->getCreatedBy($topId);
            if (
                $this->modCon->checkUserModeratesCommunity(session(LOG_U), $comId) ||
                session(LOG_U) === $createdBy
            ) {
                $this->topModel->update(['name' => $data['editarTitulo']])
                    ->where(['id' => $topId])
                    ->executeQuery();
                echo 'Título editado';
            }
        } else {
            print_r($this->topEdNam->getErrors());
        }
    }

    public function setMedia(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->topEdMed->validateForm($data)) {
            echo 'UP HERE!media';
        } else {
            print_r($this->topEdMed->getErrors());
        }
    }

    public function setContent(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->topEdCon->validateForm($data)) {
            $topId = $this->topCon->getId($data['topPagId']);
            $comId = $this->topCon->getInCommunity($topId);
            $createdBy = $this->topCon->getCreatedBy($topId);
            if (
                $this->modCon->checkUserModeratesCommunity(session(LOG_U), $comId) ||
                session(LOG_U) === $createdBy
            ) {
                $this->topModel->update(['content' => $data['editarConteudo']])
                    ->where(['id' => $topId])
                    ->executeQuery();
                echo 'Conteudo editado';
            }
        } else {
            print_r($this->topEdCon->getErrors());
        }
    }
}