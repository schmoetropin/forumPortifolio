<?php
declare(strict_types=1);

namespace Src\Code\Controllers;

use Src\Core\Controller;
use Src\Core\Request;
use Src\Code\Models\ChatModel;

class ChatController extends Controller
{
    /**
     * @var ChatModel
     */
    private ChatModel $chatModel;

    public function __construct()
    {
        parent::__construct();
        $this->chatModel = new ChatModel();
    }

    /**
     * @param Request $req
     * @return string
     */
    public function index(Request $req): string
    {
        $array = explode('/', $req->getDbRequestUri());
        $user = $this->chatModel->select(['*'])
            ->where(['unique_name' => $array[1]])
            ->getDbData();
        var_dump($user);
        return $this->view('chat', ['user' => $user[0]]);
    }
}