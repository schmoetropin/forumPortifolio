<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Models\LikeModel;
use Src\Code\Models\PostModel;
use Src\Code\Requests\LikeTopicRequest;
use Src\Code\Requests\LikePostRequest;

class LikeController extends Controller
{
    /**
     * @var LikeModel
     */
    private LikeModel $liModel;

    /**
     * @var LikeTopicRequest
     */
    private LikeTopicRequest $liTopReq;

    /**
     * @var LikePostRequest
     */
    private LikePostRequest $liPoReq;

    /**
     * @var TopicController
     */
    private TopicController $topCon;

    /**
     * @var PostController
     */
    private PostController $poCon;

    public function __construct()
    {
        parent::__construct();
        $this->liModel = new LikeModel();
        $this->liTopReq = new LikeTopicRequest();
        $this->liPoReq = new LikePostRequest();
        $this->topCon = new TopicController();
        $this->poCon = new PostController();
    }
    
    public function likeUnlikeTopic(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->liTopReq->validateForm($data)) {
            $topId = $this->topCon->getId($data['likeTopico']);
            $likeIcon = null;
            if ($this->checkIfTopicIsLiked(session(LOG_U), $topId)) {
                //unlike
                $this->unlikeTopic(session(LOG_U), $topId);
                $this->updateTopicLikes($topId, '-');
                $likeIcon = 'unlike';
            } else {
                //like
                $this->likeTopic(session(LOG_U), $topId);
                $this->updateTopicLikes($topId, '+');
                $likeIcon = 'like';
            }
            $topLikes = $this->topCon->getLikes($topId);
            echo $likeIcon.STRING_TO_ARRAY_SEPARATOR.$topLikes;
        } else {
            print_r($this->liTopReq->getErrors());
        }
    }

    public function likeUnlikePost(Request $req): void
    {
        $data = $req->validateInput();
        if ($this->liPoReq->validateForm($data)) {
            $likeIcon = null;
            $posId = (int)$data['likePost'];
            if ($this->checkIfPostIsLiked(session(LOG_U), $posId)) {
                //unlike
                $this->unlikePost(session(LOG_U), $posId);
                $this->updatePostLikes($posId, '-');
                $likeIcon = 'unlike';
            } else {
                //like
                $this->likePost(session(LOG_U), $posId);
                $this->updatePostLikes($posId, '+');
                $likeIcon = 'like';
            }
            $posLikes = $this->poCon->getLikes($posId);
            echo $likeIcon.STRING_TO_ARRAY_SEPARATOR.$posLikes;
        } else {
            print_r($this->liPoReq->getErrors());
        }
    }

    public function checkIfTopicIsLiked(int $userId, int $topicId): bool
    {
        $count = $this->liModel->select(['*'])
            ->where([
                'liked_by' => $userId,
                'in_topic' => $topicId
                ])
            ->getRowCount();
        if ($count > 0) {
            return true;
        }
        return false;
    }

    private function likeTopic(int $usId, int $topId): void
    {
        $this->liModel->insert([
            'liked_by' => $usId,
            'in_topic' => $topId,
            'in_post' => null
        ]);
    }

    private function unlikeTopic(int $usId, int $topId): void
    {
        $this->liModel->delete()
            ->where([
                'liked_by' => $usId,
                'in_topic' => $topId
            ])
            ->executeQuery();
    }

    private function updateTopicLikes(int $topId, string $type): void
    {
        $topLikes = $this->topCon->getLikes($topId);
        if ($type === '+'){
            $topLikes++;
        } else {
            $topLikes--;
        }
        $this->topCon->setLikes($topId, $topLikes);
    }

    public function checkIfPostIsLiked(int $usId, int $postId): bool
    {
        $count = $this->liModel->select(['*'])
            ->where([
                'liked_by' => $usId,
                'in_post' => $postId
            ])
            ->getRowCount();
        if ($count > 0) {
            return true;
        }
        return false;
    }

    private function likePost(int $usId, int $postId): void
    {
        $this->liModel->insert([
            'liked_by' => $usId,
            'in_topic' => null,
            'in_post' => $postId
        ]);
    }

    private function unlikePost(int $usId, int $postId): void
    {
        $this->liModel->delete()
            ->where([
                'liked_by' => $usId,
                'in_post' => $postId
            ])
            ->executeQuery();
    }

    private function updatePostLikes(int $posId, string $type): void
    {
        $posLikes = $this->poCon->getLikes($posId);
        if ($type === '+'){
            $posLikes++;
        } else {
            $posLikes--;
        }
        $this->poCon->setLikes($posId, $posLikes);
    }
}