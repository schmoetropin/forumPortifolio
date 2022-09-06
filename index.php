<?php
declare(strict_types=1);

require_once(
    __DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.
    'includes'.DIRECTORY_SEPARATOR.'include.php'
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
use Src\Code\Controllers\TopicEditController;
use Src\Code\Controllers\SubscriptionController;
use Src\Code\Controllers\ChatController;
use Src\Code\Controllers\UserEditController;
use Src\Code\Controllers\PostController;
use Src\Code\Controllers\LikeController;
use Src\Code\Controllers\SearchController;
$app = new Application();   

// Main page
$app::$app->route->get(REQ_URI_ROOT, [new MainPageController, 'index']);
$app::$app->route->get('', [new MainPageController, 'index']);
$app::$app->route->get('/', [new MainPageController, 'index']);
$app::$app->route->get('/displayCommunities', [new MainPageController, 'displayCommunities']);

// User page
$app::$app->route->post('/register', [new RegisterLoginController, 'register']);
$app::$app->route->post('/login', [new RegisterLoginController, 'login']);
$app::$app->route->post('/logout', [new RegisterLoginController, 'logout']);
$app::$app->route->get('/users/'.UNIQUE_PAGE_NAME, [new UserController, 'index']);
$app::$app->route->post('/editUserName', [new UserEditController, 'setName']);
$app::$app->route->post('/editUserEmail', [new UserEditController, 'setEmail']);
$app::$app->route->post('/editUserPic', [new UserEditController, 'setProfilePic']);
$app::$app->route->post('/editUserPass', [new UserEditController, 'setPassword']);

// Community page
$app::$app->route->post('/communityCreate', [new CommunityCreateDelete, 'create']);
$app::$app->route->get('/communities/'.UNIQUE_PAGE_NAME, [new CommunityController, 'index']);
$app::$app->route->post('/editCommunityPic', [new CommunityEditController, 'setCommunityPicture']);
$app::$app->route->post('/editCommunityName', [new CommunityEditController, 'setName']);
$app::$app->route->post('/editCommunityDesc', [new CommunityEditController, 'setDescription']);
$app::$app->route->post('/displayUpdatedCommunity', [new CommunityController, 'displayUpdatedDataCommunity']);
$app::$app->route->post('/communityDelete', [new CommunityCreateDelete, 'delete']);
$app::$app->route->post('/displayTopics', [new CommunityController, 'displayTopics']);

// Subscription
$app::$app->route->post('/subscribe', [new SubscriptionController, 'subscribe']);

// Topic page
$app::$app->route->get('/topics/'.UNIQUE_PAGE_NAME, [new TopicController, 'index']);
$app::$app->route->post('/createTopic', [new TopicCreateDelete, 'create']);
$app::$app->route->post('/deleteTopic', [new TopicCreateDelete, 'delete']);
$app::$app->route->post('/editTopicName', [new TopicEditController, 'setName']);
$app::$app->route->post('/editTopicMedia', [new TopicEditController, 'setMedia']);
$app::$app->route->post('/editTopicContent', [new TopicEditController, 'setContent']);
$app::$app->route->post('/displayTopic', [new TopicController, 'displayTopic']);
$app::$app->route->post('/displayPost', [new TopicController, 'displayPosts']);

// Post
$app::$app->route->post('/createPost', [new PostController, 'create']);
$app::$app->route->post('/editPost', [new PostController, 'editPost']);

// Like
$app::$app->route->post('/likeTopic', [new LikeController, 'likeUnlikeTopic']);
$app::$app->route->post('/likePost', [new LikeController, 'likeUnlikePost']);

// Chat page and messages
$app::$app->route->get('/chat/'.UNIQUE_PAGE_NAME, [new ChatController, 'index']);

// Search page
$app::$app->route->post('/search', [new SearchController, 'index']);
$app::$app->route->get('/search', [new SearchController, 'index']);

// Display pages
$app::$app->resolve();