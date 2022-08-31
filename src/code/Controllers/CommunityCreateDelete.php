<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Requests\CommunityCreateRequest;
use Src\Code\Requests\CommunityDeleteRequest;
use Src\Code\Models\CommunityModel;
use Src\Code\Models\TopicModel;

class CommunityCreateDelete extends Controller
{
    /**
     * @var CommunityCreateRequest
     */
    private CommunityCreateRequest $comReq;

    /**
     * @var CommunityDeleteRequest
     */
    private CommunityDeleteRequest $comDelReq;

    /**
     * @var CommunityModel
     */
    private CommunityModel $comModel;

    /**
     * @var CommunityController
     */
    private CommunityController $comCon;

    /**
     * @var UserController
     */
    private UserController $usCont;

    /**
     * @var ModeratorController
     */
    private ModeratorController $modCon;

    /**
     * @var TopicModel
     */
    private TopicModel $topModel;

    public function __construct()
    {
        parent::__construct();
        $this->comReq = new CommunityCreateRequest();
        $this->comModel = new CommunityModel();
        $this->comCon = new CommunityController();
        $this->usCont = new UserController();
        $this->modCon = new ModeratorController();
        $this->comDelReq = new CommunityDeleteRequest();
        $this->topModel = new TopicModel();
    }

    /**
     * @param Request
     * @return void
     */
    public function create(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->comReq->validateForm($data)) {
            $uniqueName = $this->createUniqueName(
                $data['nomeComunidade'], $this->comModel->tableName()
            );
            $date = date('Y-m-d H:i:s');
            $picture = $this->createFile($data['fotoComunidade'], session(LOG_U));
            $this->comModel->insert([
                'name' => $data['nomeComunidade'],
                'unique_name'=> $uniqueName,
                'description' => $data['descricaoComunidade'],
                'community_picture' => $picture,
                'created_at' => $date,
                'updated_at' => $date,
                'created_by' => session(LOG_U)
            ]);
            $id = $this->comCon->getId($uniqueName);
            $this->modCon->createNewModerator(session(LOG_U), $id);
            $this->moveFile($data['fotoComunidade'], $picture);
            echo 'Comunidade criada';
        } else {
            print_r($this->comReq->getErrors());
        }
    }

    /**
     * @param Request $req
     * @return void
     */
    public function delete(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->comDelReq->validateForm($data)) {
            $comId = $this->comCon->getId($data['comunidade']);
            if ($this->modCon->checkUserModeratesCommunity(session(LOG_U), $comId)) {
                $comName = strtoupper($this->comCon->getName($comId));
                $str = 'SIM, DELETAR A COMUNIDADE '.$comName;
                if ($data['confirmacaoDeletarComunidade'] === $str) {
                    $topFiles = $this->topModel->select(['file'])
                        ->where(['in_community' => $comId])
                        ->getDbData();
                    $count = count($topFiles);
                    for ($i = 0; $i < $count; $i++) {
                        $this->deleteFile($topFiles[$i]['file']);
                    }
                    $communityPic = $this->comCon->getCommunityPicture($comId);
                    $this->deleteFile($communityPic);
                    $this->comModel->delete()
                        ->where(['id' => $comId])
                        ->executeQuery();
                    if ($this->modCon->quantityOfCommunitiesUserModerates(session(LOG_U)) === 0) {
                        $this->usCont->setUserType($userId, 1);
                    }
                }
            }
        }
    }
}