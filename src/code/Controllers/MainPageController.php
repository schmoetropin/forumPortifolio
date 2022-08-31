<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Code\Models\CommunityModel;

class MainPageController extends Controller
{
    /**
     * @var CommunityModel
     */
    private CommunityModel $comModel;

    public function __construct()
    {
        parent::__construct();
        $this->comModel = new CommunityModel();
    }
    /**
     * @return string
     */
    public function index(): string
    {
        $data = $this->comModel->select(['*'])
            ->order('id', 'desc')
            ->getDbData();
        return $this->view('main', ['coms' => $data]);
    }

    public function displayCommunities(): void
    {
        $data = $this->comModel->select(['*'])
            ->order('id', 'desc')
            ->getDbData();
        $coms = $data;
        require_once(MAIN_PATH.'communitiesDisplay.php');
    }
}