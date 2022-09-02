<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Code\Models\TopicModel;
use Src\Code\Models\CommunityModel;

class MainPageController extends Controller
{
    private TopicModel $topModel;

    /**
     * @var CommunityModel
     */
    private CommunityModel $comModel;

    public function __construct()
    {
        parent::__construct();
        $this->topModel = new TopicModel();
        $this->comModel = new CommunityModel();
    }
    /**
     * @return string
     */
    public function index(): string
    {
        $top4Top = $this->topModel->select(['*'])
            ->order('likes', 'desc')
            ->limit(4)
            ->getDbData();
        
        $data = $this->comModel->select(['*'])
            ->order('id', 'desc')
            ->getDbData();
        
        return $this->view('main', [
            'top4' => $top4Top,
            'coms' => $data
        ]);
    }

    /**
     * @return void
     */
    public function displayCommunities(): void
    {
        $data = $this->comModel->select(['*'])
            ->order('id', 'desc')
            ->getDbData();
        $coms = $data;
        require_once(MAIN_PATH.'communitiesDisplay.php');
    }
}