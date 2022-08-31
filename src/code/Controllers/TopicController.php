<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Models\TopicModel;

class TopicController extends Controller
{
    /**
     * @var TopicModel
     */
    private TopicModel $topModel;

    public function __construct()
    {
        parent::__construct();
        $this->topModel = new TopicModel();
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
            ->getDbData()[0];
        return $this->view('topic', ['top' => $top]);
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
     * @return string
     */
    public function getFile(int $id): ?string
    {
        return $this->topModel->select(['file'])
            ->where(['id' => $id])
            ->getDbData()[0]['file'];
    }

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
}