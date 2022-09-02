<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Models\TopicModel;
use Src\Code\Models\PostModel;

class TopicController extends Controller
{
    /**
     * @var TopicModel
     */
    private TopicModel $topModel;

    /**
     * @var PostModel
     */
    private PostModel $poModel;

    public function __construct()
    {
        parent::__construct();
        $this->topModel = new TopicModel();
        $this->poModel = new PostModel();
    }

    /**
     * @param Request $req
     * @return string
     */
    public function index(Request $req): string
    {
        $data = $req->getDbRequestUri();
        $array = explode('/', $data);
        $top = $this->topModel->select(['*'])
            ->where(['unique_name' => $array[1]])
            ->getDbData();

        $topId = $this->getId($array[1]);
        $pos = $this->poModel->select(['*'])
            ->where(['in_topic' => $topId])
            ->getDbData();
        return $this->view('topic', [
            'top' => $top[0],
            'pos' => $pos
        ]);
    }

    /**
     * @param $req
     * @return void
     */
    public function displayTopic(Request $req): void
    {
        $data = $req->validateInput();
        $topId = $this->getId($data['topic']);
        $top = $this->topModel->select(['*'])
            ->where(['id' => $topId])
            ->getDbData()[0];
        require_once(TOPIC_PATH.'mainTopic.php');
    }

    /**
     * @param $req
     * @return void
     */
    public function displayPosts(Request $req): void
    {
        $data = $req->validateInput();
        $topId = $this->getId($data['topic']);
        $pos = $this->poModel->select(['*'])
            ->where(['in_topic' => $topId])
            ->getDbData();
        require_once(TOPIC_PATH.'displayPosts.php');
    }

    /**
     * @param string $uniqueName
     * @return int
     */
    public function getId(string $uniqueName): int
    {
        return $this->topModel->select(['id'])
            ->where(['unique_name' => $uniqueName])
            ->getDbData()[0]['id'];
    }

    /**
     * @param int $id
     * @return string|null
     */
    public function getFile(int $id): ?string
    {
        return $this->topModel->select(['file'])
            ->where(['id' => $id])
            ->getDbData()[0]['file'];
    }

    /**
     * @param int $id
     * @return int
     */
    public function getInCommunity(int $id): int
    {
        return $this->topModel->select(['in_community'])
            ->where(['id' => $id])
            ->getDbData()[0]['in_community'];
    }

    public function getCreatedBy(int $id): int
    {
        return $this->topModel->select(['created_by'])
            ->where(['id' => $id])
            ->getDbData()[0]['created_by'];
    }

    public function getPosts(int $id): int
    {
        return $this->topModel->select(['posts'])
            ->where(['id' => $id])
            ->getDbData()[0]['posts'];
    }

    public function getLikes(int $id): int
    {
        return $this->topModel->select(['likes'])
            ->where(['id' => $id])
            ->getDbData()[0]['likes'];
    }

    public function setPosts(int $id, int $value): void
    {
        $this->topModel->update(['posts' => $value])
            ->where(['id' => $id])
            ->executeQuery();
    }

    public function setLikes(int $id, int $value): void
    {
        $this->topModel->update(['likes' => $value])
            ->where(['id' => $id])
            ->executeQuery();
    }
}