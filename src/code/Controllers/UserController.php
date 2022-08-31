<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Models\UserModel;

class UserController extends Controller
{
    /**
     * @var UserModel
     */
    private UserModel $usModel;

    public function __construct()
    {
        parent::__construct();
        $this->usModel = new UserModel();
    }

    /**
     * @param Request $req
     * @return string
     */
    public function index(Request $req): string
    {
        $dbReq = $req->getDbRequestUri();
        $array = explode('/', $dbReq);
        $this->usModel->select(['*'])
            ->where(['unique_name' => $array[1]]);
        $user = $this->usModel->getDbData();
        return $this->view('user', ['us' => $user[0]]);
    }

    /**
     * GETTERS
     */

    /**
     * @param $id
     * @return string
     */
    public function getUniqueName(int $id): string
    {
        return $this->usModel->select(['unique_name'])
            ->where(['id' => $id])
            ->getDbData()[0]['unique_name'];
    }

    /**
     * @param int $id
     * @return int
     */
    public function getNumberSubscriptions(int $id): int
    {
        return $this->usModel->select(['number_subscriptions'])
            ->where(['id' => $id])
            ->getDbData()[0]['number_subscriptions'];
    }

    /**
     * @param int $id
     * @return string
     */
    public function getName(int $id): string
    {
        return $this->usModel->select(['name'])
            ->where(['id' => $id])
            ->getDbData()[0]['name'];
    }

    /**
     * @param int $id
     * @return string
     */
    public function getProfilePic(int $id): string
    {
        return $this->usModel->select(['profile_pic'])
            ->where(['id' => $id])
            ->getDbData()[0]['profile_pic'];
    }

    /**
     * @param int $id
     * @return int
     */
    public function getNumberTopics(int $id): int
    {
        return $this->usModel->select(['number_topics'])
            ->where(['id' => $id])
            ->getDbData()[0]['number_topics'];
    }

    /**
     * @param int $id
     * @return string
     */
    public function getEmail(int $id): string
    {
        return $this->usModel->select(['email'])
            ->where(['id' => $id])
            ->getDbData()[0]['email'];
    }

    /**
     * SETTERS
     */

    /**
     * @param int $type
     * @return void
     */
    public function setUserType(int $id, int $type): void
    {
        $this->usModel->update(['user_type' => $type])
            ->where(['id' => $id])
            ->executeQuery();
    }

    /**
     * @param int $id
     * @param int $value
     * @return void
     */
    public function setNumberSubscriptions(int $id, int $value): void
    {
        $this->usModel->update(['number_subscriptions' => $value])
            ->where(['id' => $id])
            ->executeQuery();
    }

     /**
     * @param int $id
     * @param int $value
     * @return void
     */
    public function setNumberTopics(int $id, int $value): void
    {
        $this->usModel->update(['number_topics' => $value])
            ->where(['id' => $id])
            ->executeQuery();
    }
}