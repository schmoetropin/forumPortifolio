<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Requests\SubscriptionRequest;
use Src\Code\Models\SubscriptionModel;

class SubscriptionController extends Controller
{
    /**
     * @var SubscriptionRequest
     */
    private SubscriptionRequest $subReq;

    /**
     * @var SubscriptionModel
     */
    private SubscriptionModel $subModel;

    /**
     * @var CommunityController
     */
    private CommunityController $comCon;

    /**
     * @var CommunityEditController
     */
    private CommunityEditController $comEdCon;

    /**
     * @var UserController
     */
    private UserController $usCon;

    public function __construct()
    {
        parent::__construct();
        $this->subReq = new SubscriptionRequest();
        $this->subModel = new SubscriptionModel();
        $this->comCon = new CommunityController();
        $this->conEdCon = new CommunityEditController();
        $this->usCon = new UserController();
    }

    /**
     * @param Request $req
     * @return void
     */
    public function subscribe(Request $req): void
    {
        $data = $req->validateinput();
        if ($this->subReq->validateForm($data)) {
            $comId = $this->comCon->getId($data['comunidade']);
            $comUniqueN = $data['comunidade'];
            $comSubs = $this->comCon->getSubscribers($comId);
            $usSubs = $this->usCon->getNumberSubscriptions(session(LOG_U));
            if ($this->checkUserSubscription(session(LOG_U), $comId)) {
                $this->unsubscribeOpt($comId, session(LOG_U), $comSubs, $usSubs);
            } else {
                $this->subscribeOpt($comId, session(LOG_U), $comSubs, $usSubs);
            }
            require_once(COMMUNITY_PATH.'subscribeLr.php');
            echo STRING_TO_ARRAY_SEPARATOR;
            require_once(COMMUNITY_PATH.'subscribeHr.php');
        }
    }

    /**
     * @param string $user
     * @param int $community
     * @return bool
     */
    public function checkUserSubscription(int $user, int $community): bool
    {
        $this->subModel->select(['*'])
            ->where([
                'user' => $user,
                'community' => $community
            ]);
        $count = $this->subModel->getRowCount();
        if ($count > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param int $communityId
     * @param int $userId
     * @param int $communitySubs
     * @param int $userSubs
     * @return void
     */
    private function subscribeOpt(
        int $communityId, int $userId, int $communitySubs, int $userSubs
    ): void
    {
        $this->subModel->insert([
            'user' => $userId,
            'community' => $communityId
        ]);
        $communitySubs++;
        $userSubs++;
        $this->updateSubscriptions($communityId, $userId, $communitySubs, $userSubs);
    }

    private function unsubscribeOpt(
        int $communityId, int $userId, int $communitySubs, int $userSubs
    ): void
    {
        $this->subModel->delete()
            ->where([
                'user' => $userId,
                'community' => $communityId
            ])
            ->executeQuery();
        $communitySubs--;
        $userSubs--;
        $this->updateSubscriptions($communityId, $userId, $communitySubs, $userSubs);
    }

    private function updateSubscriptions(
        int $communityId, int $userId, int $communitySubs, int $userSubs
    ): void
    {
        $this->conEdCon->setSubscribers($communityId, $communitySubs);
        $this->usCon->setNumberSubscriptions($userId, $userSubs);
    }
}