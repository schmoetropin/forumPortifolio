<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Models\ModeratorModel;
use Src\Code\Models\UserModel;

class ModeratorController extends Controller
{
    /**
     * @var ModeratorModel
     */
    private ModeratorModel $modModel;

    /**
     * @var UserController
     */
    private UserController $usCont;

    public function __construct()
    {
        parent::__construct();
        $this->modModel = new ModeratorModel();
        $this->usCont = new UserController();
    }

    /**
     * @param string $userId
     * @param int $communityId
     * @return void
     */
    public function createNewModerator(int $userId, int $communityId): void
    {
        $this->modModel->insert([
            'moderator' => $userId,
            'community' => $communityId
        ]);
        $this->usCont->setUserType($userId, 2);
    }

    /**
     * @param string $moderator
     * @param int $community
     * @return bool
     */
    public function checkUserModeratesCommunity(int $moderator, int $community): bool
    {
        $this->modModel->select(['id'])
            ->where([
                'moderator' => $moderator,
                'community' => $community
            ]);
        $count = $this->modModel->getRowCount();
        if ($count > 0) {
            return true;
        }
        return false;
    }

    public function quantityOfCommunitiesUserModerates(int $moderator): int
    {
        return $this->modModel->select(['*'])
            ->where(['moderator' => $moderator])
            ->getRowCount();
    }
}