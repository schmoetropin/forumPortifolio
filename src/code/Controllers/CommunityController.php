<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Models\CommunityModel;
use Src\Code\Models\TopicModel;

class CommunityController extends Controller
{
    /**
     * @var CommunityModel
     */
    private CommunityModel $comModel;

    /**
     * @var TopicModel
     */
    private TopicModel $topModel;

    public function __construct()
    {
        parent::__construct();
        $this->comModel = new CommunityModel();
        $this->topModel = new TopicModel();
    }

    /**
     * @param Request $req
     * @return string
     */
    public function index(Request $req): string
    {
        $dbReq = $req->getDbRequestUri();
        $array = explode('/', $dbReq);
        $this->comModel->select(['*'])
            ->where(['unique_name' => $array[1]]);
        $community = $this->comModel->getDbData();

        $comId = $this->getId($array[1]);
        $topics = $this->topModel->select(['*'])
                    ->where(['in_community' => $comId])
                    ->order('updated_at', 'desc')
                    ->getDbData();

        return $this->view('community', [
            'com' => $community[0],
            'tops' => $topics
        ]);
    }

    /**
     * @param Request $req
     * @return void
     */
    public function displayTopics(Request $req): void
    {
        $data = $req->validateInput();
        $comId = $this->getId($data['comunidade']);
        $tops = $this->topModel->select(['*'])
                    ->where(['in_community' => $comId])
                    ->order('updated_at', 'desc')
                    ->getDbData();
        require_once(COMMUNITY_PATH.'displayTopics.php');
    }

    /**
     * @param Request $req
     * @return void
     */
    public function displayUpdatedDataCommunity(Request $req): void
    {
        $data = $req->validateInput();
        $id = $this->getId($data['comunidade']);
        $pic = $this->getCommunityPicture($id);
        $name = $this->getName($id);
        $desc = $this->getDescription($id);
        echo $pic.STRING_TO_ARRAY_SEPARATOR.$name.STRING_TO_ARRAY_SEPARATOR.$desc;
    }

    /**
     * @param string $uniqueName
     * @return int
     */
    public function getId(string $uniqueName): int
    {
        return $this->comModel->select(['id'])
            ->where(['unique_name' => $uniqueName])
            ->getDbData()[0]['id'];
    }

    /**
     * @param int $id
     * @return string
     */
    public function getCommunityPicture(int $id): string
    {
        return $this->comModel->select(['community_picture'])
            ->where(['id' => $id])
            ->getDbData()[0]['community_picture'];
    }

    /**
     * @param int $id
     * @return string
     */
    public function getName(int $id): string
    {
        return $this->comModel->select(['name'])
            ->where(['id' => $id])
            ->getDbData()[0]['name'];
    }

    /**
     * @param int $id
     * @return string
     */
    public function getDescription(int $id): string
    {
        return $this->comModel->select(['description'])
            ->where(['id' => $id])
            ->getDbData()[0]['description'];
    }

    /**
     * @param int $id
     * @return int
     */
    public function getSubscribers(int $id): int
    {
        return $this->comModel->select(['subscribers'])
            ->where(['id' => $id])
            ->getDbData()[0]['subscribers'];
    }

    /**
     * @param int $id
     * @return int
     */
    public function getTopics(int $id): int
    {
        return $this->comModel->select(['topics'])
            ->where(['id' => $id])
            ->getDbData()[0]['topics'];
    }

    /**
     * @param int $id
     * @return int
     */
    public function getPosts(int $id): int
    {
        return $this->comModel->select(['posts'])
            ->where(['id' => $id])
            ->getDbData()[0]['posts'];
    }

    /**
     * @param int $id
     * @return int
     */
    public function getUniqueName(int $id): string
    {
        return $this->comModel->select(['unique_name'])
            ->where(['id' => $id])
            ->getDbData()[0]['unique_name'];
    }

    public function setPosts(int $id, int $value): void
    {
        $this->comModel->update(['posts' => $value])
            ->where(['id' => $id])
            ->executeQuery();
    }
}