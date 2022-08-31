<?php
declare(strict_types=1);

require_once(
    __DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR
    .'includes'.DIRECTORY_SEPARATOR.'include.php'
);

use Src\Core\Application;
use Src\Code\Controllers\MainPageController;
use Src\Code\Controllers\RegisterLoginController;
use Src\Code\Controllers\CommunityController;
use Src\Code\Controllers\CommunityCreateDelete;
use Src\Code\Controllers\CommunityEditController;
use Src\Code\Controllers\UserController;
use Src\Code\Controllers\TopicController;
use Src\Code\Controllers\TopicCreateDelete;
use Src\Code\Controllers\SubscriptionController;

$app = new Application();   

$app::$app->route->get(REQ_URI_ROOT, [new MainPageController, 'index']);
$app::$app->route->get('', [new MainPageController, 'index']);
$app::$app->route->get('/', [new MainPageController, 'index']);
$app::$app->route->get('/displayCommunities', [new MainPageController, 'displayCommunities']);

$app::$app->route->post('/register', [new RegisterLoginController, 'register']);
$app::$app->route->post('/login', [new RegisterLoginController, 'login']);
$app::$app->route->post('/logout', [new RegisterLoginController, 'logout']);
$app::$app->route->get('/users/'.UNIQUE_PAGE_NAME, [new UserController, 'index']);

$app::$app->route->post('/communityCreate', [new CommunityCreateDelete, 'create']);
$app::$app->route->get('/communities/'.UNIQUE_PAGE_NAME, [new CommunityController, 'index']);
$app::$app->route->post('/editCommunityPic', [new CommunityEditController, 'setCommunityPicture']);
$app::$app->route->post('/editCommunityName', [new CommunityEditController, 'setName']);
$app::$app->route->post('/editCommunityDesc', [new CommunityEditController, 'setDescription']);
$app::$app->route->post('/displayUpdatedCommunity', [new CommunityController, 'displayUpdatedDataCommunity']);
$app::$app->route->post('/communityDelete', [new CommunityCreateDelete, 'delete']);
$app::$app->route->post('/displayTopics', [new CommunityController, 'displayTopics']);

$app::$app->route->post('/subscribe', [new SubscriptionController, 'subscribe']);

$app::$app->route->get('/topics/'.UNIQUE_PAGE_NAME, [new TopicController, 'index']);
$app::$app->route->post('/createTopic', [new TopicCreateDelete, 'create']);
$app::$app->route->post('/deleteTopic', [new TopicCreateDelete, 'delete']);

$app::$app->resolve();