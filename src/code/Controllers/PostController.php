<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Models\PostModel;
use Src\Code\Requests\PostCreateRequest;
use Src\Code\Requests\PostEditRequest;

class PostController extends Controller
{
    /**
     * @var UserController
     */
    private UserController $usCont;

    /**
     * @var PostModel
     */
    private PostModel $poModel;

    /**
     * @var PostCreateRequest
     */
    private PostCreateRequest $poCrReq;

    /**
     * @var PostEditRequest
     */
    private PostEditRequest $poEdReq;

    /**
     * @var TopicController
     */
    private TopicController $topCon;

    /**
     * @var CommunityController
     */
    private CommunityController $comCon;

    /**
     * @var ModeratorController
     */
    private ModeratorController $modCon;

    public function __construct()
    {
        parent::__construct();
        $this->usCont = new UserController();
        $this->poModel = new PostModel();
        $this->poCrReq = new PostCreateRequest();
        $this->topCon = new TopicController();
        $this->comCon = new CommunityController();
        $this->poEdReq = new PostEditRequest();
        $this->modCon = new ModeratorController();
    }

    public function create(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->poCrReq->validateForm($data)) {
            $date = date('Y-m-d H:i:s');
            $topId = $this->topCon->getId($data['nomeTopico']);
            $comId = $this->topCon->getInCommunity($topId);
            $this->poModel->insert([
                'content' => $data['postConteudo'],
                'created_at' => $date,
                'updated_at' => $date,
                'created_by' => session(LOG_U),
                'in_topic' => $topId,
                'in_community' => $comId
            ]);
            $userNumPosts = $this->usCont->getNumberPosts(session(LOG_U));
            $userNumPosts++;
            $this->usCont->setNumberPosts(session(LOG_U), $userNumPosts);

            $comNumPosts = $this->comCon->getPosts($comId);
            $comNumPosts++;
            $this->comCon->setPosts($comId, $comNumPosts);

            $topNumPosts = $this->topCon->getPosts($topId);
            $topNumPosts++;
            $this->topCon->setPosts($topId, $topNumPosts);
            echo 'Post criado';
        } else {
            print_r($this->poCrReq->getErrors());
        }
    }

    public function editPost(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->poEdReq->validateForm($data)) {
            $postId = (int)$data['editPostId'];
            $comId = $this->getInCommunity($postId);
            $createdBy = $this->getCreatedBy($postId);
            if (
                $this->modCon->checkUserModeratesCommunity(session(LOG_U), $comId) ||
                session(LOG_U) === $createdBy
            ) {
                $this->poModel->update(['content' => $data['editarPostTextarea']])
                    ->where(['id' => $postId])
                    ->executeQuery();
                echo 'Post Editado';
            }
        } else {
            print_r($this->poEdReq->getErrors());
        }
    }

    public function getLikes(int $postId): int
    {
        return $this->poModel->select(['likes'])
            ->where(['id' => $postId])
            ->getDbData()[0]['likes'];
    }

    public function getCreatedBy(int $postId): int
    {
        return $this->poModel->select(['created_by'])
            ->where(['id' => $postId])
            ->getDbData()[0]['created_by'];
    }

    public function getInCommunity(int $postId): int
    {
        return $this->poModel->select(['in_community'])
            ->where(['id' => $postId])
            ->getDbData()[0]['in_community'];
    }

    public function setLikes(int $postId, int $value): void
    {
        $this->poModel->update(['likes' => $value])
            ->where(['id' => $postId])
            ->executeQuery();
    }
}