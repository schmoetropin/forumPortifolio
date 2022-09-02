<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Models\CommunityModel;

class SearchController extends Controller
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
    
    public function index(Request $req): string
    {
        $data = $req->validateInput();
        $coms = $this->comModel->select(['*'])
            ->whereLike(['name' => $data['resultado']])
            ->getDbData();
        if (isset($data['resultado'])) {
            return $this->view('search', [
                'search' => $data['resultado'],
                'coms' => $coms
            ]);
        }
        return $this->view('search', ['coms' => $coms]);
    }
    
}