<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Requests\TopicCreateRequest;
use Src\Code\Requests\TopicDeleteRequest;
use Src\Code\Models\TopicModel;

class TopicCreateDelete extends Controller
{
    /**
     * @var TopicCreateRequest
     */
    private TopicCreateRequest $topReq;

    /**
     * @var TopicModel
     */
    private TopicModel $topModel;

    /**
     * @var CommunityController
     */
    private CommunityController $comCon;

    /**
     * @var SubscriptionController
     */
    private SubscriptionController $subCon;

    /**
     * @var UserController
     */
    private UserController $usCon;

    /**
     * @var CommunityEditController
     */
    private CommunityEditController $comEdCon;

    /**
     * @var TopicDeleteRequest
     */
    private TopicDeleteRequest $topDelRec;

    /**
     * @var TopicController
     */
    private TopicController $topCon;

    /**
     * @var ModeratorController
     */
    private ModeratorController $modCon;

    public function __construct()
    {
        parent::__construct();
        $this->topReq = new TopicCreateRequest();
        $this->topModel = new TopicModel();
        $this->comCon = new CommunityController();
        $this->subCon = new SubscriptionController();
        $this->usCon = new UserController();
        $this->comEdCon = new CommunityEditController();
        $this->topDelRec = new TopicDeleteRequest();
        $this->topCon = new TopicController();
        $this->modCon = new ModeratorController();
    }

    /**
     * @param Request $req
     * @return void
     */
    public function create(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->topReq->validateForm($data)) {
            $midia = $this->midiaType(
                $data['topicoArquivoRadio'], $data['topicoUpload'], $data['topicoLink']
            );
            $uniqueName = $this->topModel->uniqueName($data['tituloTopico']);
            $date = date('Y-m-d H:i:s');
            $comId = $this->comCon->getId($data['topicoComunidade']);
            if ($this->subCon->checkUserSubscription(session(LOG_U), $comId)) {
                $this->topModel->insert([
                    'name' => $data['tituloTopico'], 
                    'unique_name' => $uniqueName, 
                    'content' => $data['conteudoTopico'], 
                    'file_extension' => $midia['extension'],
                    'file' => $midia['file'],
                    'link' => $midia['link'], 
                    'created_at' => $date, 
                    'updated_at' => $date, 
                    'created_by' => session(LOG_U),
                    'in_community' => $comId
                ]);
                if (!is_null($midia['file'])) {
                    $this->moveFile($data['topicoUpload'], $midia['file']);
                }
                
                $usTopics = $this->usCon->getNumberTopics(session(LOG_U));
                $usTopics++;
                $this->usCon->setNumberTopics(session(LOG_U), $usTopics);

                $comTopics = $this->comCon->getTopics($comId);
                $comTopics++;
                $this->comEdCon->setTopics($comId, $comTopics);

                echo 'Topico criado';
            } else {
                echo 'Você não é inscrito nesta comunidade';
            }  
        } else {
            print_r($this->topReq->getErrors());
        }
    }

    /**
     * @param Request $req
     * @return void
     */
    public function delete(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->topDelRec->validateForm($data)) {
            $topId = $this->topCon->getId($data['topico']);
            $community = $this->topCon->getInCommunity($topId);
            $createdBy = $this->topCon->getCreatedBy($topId);
            $file = $this->topCon->getFile($topId);
            if(
                $this->modCon->checkUserModeratesCommunity(session(LOG_U), $community) || 
                session(LOG_U) === $createdBy
            ) {
                $usEmail = strtoupper($this->usCon->getEmail(session(LOG_U)));
                if ($data['delTopTextConfirmacao'] === $usEmail) {
                    if (!is_null($file)) {
                        $this->deleteFile($file);
                    }

                    $usTopics = $this->usCon->getNumberTopics(session(LOG_U));
                    $usTopics--;
                    $this->usCon->setNumberTopics(session(LOG_U), $usTopics);

                    $comTopics = $this->comCon->getTopics($community);
                    $comTopics--;
                    $this->comEdCon->setTopics($community, $comTopics);

                    $this->topModel->delete()
                        ->where(['id' => $topId])
                        ->executeQuery();
                }
            }
        }
    }

    /**
     * @param string $link
     * @return bool
     */
    private function checkLink(string $link): bool
    {
        $linkCompare = 'https://www.youtube.com/watch?v=';
        $linkCheck = substr($link, 0, 32);
        if ($linkCompare === $linkCheck) {
            return true;
        }
        return false;
    }

    /**
     * @param string $option
     * @param array $fileArr
     * @param string $linkYou
     * @return array
     */
    private function midiaType(string $option, array $fileArr, string $linkYou): array
    {
        $file;
        $extension;
        $link;
        if ($option === 'upload') {
            $file = $this->createFile($fileArr, session(LOG_U));
            $extension = $this->getExtension($fileArr);
            $link = null;
        } elseif ($option === 'linkVideo') {
            $file = null;
            $extension = null;
            if ($this->checkLink($linkYou)) {
                $pos = strpos($linkYou, '&');
                if ($pos) {
                    $link = substr($linkYou, 0, $pos);
                } else {
                    $link = $linkYou;
                }
            }
        } else {
            $file = null;
            $extension = null;
            $link = null;
        }
        return [
            'file' => $file,
            'extension' => $extension,
            'link' => $link
        ];
    }
}