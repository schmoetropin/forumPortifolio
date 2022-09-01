<?php
declare(strict_types=1);

// Displays error for development
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Root directory
define('ROOT', dirname(__DIR__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR);

// Src path and subfolders
define('SRC_PATH', ROOT.'src'.DIRECTORY_SEPARATOR);
define('CORE_PATH', SRC_PATH.'core'.DIRECTORY_SEPARATOR);
define('CODE_PATH', SRC_PATH.'code'.DIRECTORY_SEPARATOR);
define('CONTROLLERS_PATH', CODE_PATH.'Controllers'.DIRECTORY_SEPARATOR);
define('MODELS_PATH', CODE_PATH.'Models'.DIRECTORY_SEPARATOR);
define('REQUESTS_PATH', CODE_PATH.'Requests'.DIRECTORY_SEPARATOR);
define('PAGES_REQUIRE_PATH', CODE_PATH.'PagesRequire'.DIRECTORY_SEPARATOR);

// Pages require
define('MAIN_PATH', PAGES_REQUIRE_PATH.'main'.DIRECTORY_SEPARATOR);
define('COMMUNITY_PATH', PAGES_REQUIRE_PATH.'community'.DIRECTORY_SEPARATOR);
define('TOPIC_PATH', PAGES_REQUIRE_PATH.'topic'.DIRECTORY_SEPARATOR);

// Public path and subfolders
define('PUBLIC_PATH', ROOT.'public'.DIRECTORY_SEPARATOR);
define('PAGES_PATH', PUBLIC_PATH.'pages'.DIRECTORY_SEPARATOR);
define('LAYOUT_PATH', PUBLIC_PATH.'layout'.DIRECTORY_SEPARATOR);
define('UPLOAD_PATH', PUBLIC_PATH.'uploads'.DIRECTORY_SEPARATOR);

require_once(SRC_PATH.'config.php');

// Request_uri, path for assets and uploads
define('REQ_URI_ROOT', $const['REQ_URI_ROOT']);
define('REQ_URI', REQ_URI_ROOT.'index.php');
define('UNIQUE_PAGE_NAME', '{unique_name}');
define('URL', $const['URL']);
define('PUBLIC_HOST', URL.'public/');
define('ASSETS', PUBLIC_HOST.'assets/');
define('CSS', ASSETS.'css/');
define('CSS_RES', CSS.'resolucoes/');
define('IMG', ASSETS.'images/');
define('JS', ASSETS.'js/');
define('UPLOAD', PUBLIC_HOST.'uploads/');
define('STRING_TO_ARRAY_SEPARATOR', '[*SEPARATOR*]');

// Log user
define('LOG_U', 'logUser');

// Core require
require_once(CORE_PATH.'Connection.php');
require_once(CORE_PATH.'Request.php');
require_once(CORE_PATH.'Route.php');
require_once(CORE_PATH.'View.php');
require_once(CORE_PATH.'CheckFileTrait.php');
require_once(CORE_PATH.'CheckInputTrait.php');
require_once(CORE_PATH.'FormValidation.php');
require_once(CORE_PATH.'Model.php');
require_once(CORE_PATH.'Query.php');
require_once(CORE_PATH.'ConfigurableRoutePath.php');
require_once(CORE_PATH.'Session.php');
require_once(CORE_PATH.'Controller.php');
require_once(CORE_PATH.'Application.php');

// Controllers require
require_once(CONTROLLERS_PATH.'MainPageController.php');
require_once(CONTROLLERS_PATH.'RegisterLoginController.php');
require_once(CONTROLLERS_PATH.'UserController.php');
require_once(CONTROLLERS_PATH.'CommunityController.php');
require_once(CONTROLLERS_PATH.'CommunityCreateDelete.php');
require_once(CONTROLLERS_PATH.'ModeratorController.php');
require_once(CONTROLLERS_PATH.'CommunityEditController.php');
require_once(CONTROLLERS_PATH.'TopicController.php');
require_once(CONTROLLERS_PATH.'TopicCreateDelete.php');
require_once(CONTROLLERS_PATH.'TopicEditController.php');
require_once(CONTROLLERS_PATH.'SubscriptionController.php');
require_once(CONTROLLERS_PATH.'ChatController.php');
require_once(CONTROLLERS_PATH.'UserEditController.php');
require_once(CONTROLLERS_PATH.'PostController.php');

require_once(CONTROLLERS_PATH.'SearchController.php');

// Models require
require_once(MODELS_PATH.'UserModel.php');
require_once(MODELS_PATH.'CommunityModel.php');
require_once(MODELS_PATH.'ModeratorModel.php');
require_once(MODELS_PATH.'TopicModel.php');
require_once(MODELS_PATH.'SubscriptionModel.php');
require_once(MODELS_PATH.'ChatModel.php');
require_once(MODELS_PATH.'PostModel.php');

// Requests require
require_once(REQUESTS_PATH.'RegisterRequest.php');
require_once(REQUESTS_PATH.'CommunityCreateRequest.php');
require_once(REQUESTS_PATH.'CommunityDeleteRequest.php');
require_once(REQUESTS_PATH.'CommunityEditPictureRequest.php');
require_once(REQUESTS_PATH.'CommunityEditNameRequest.php');
require_once(REQUESTS_PATH.'CommunityEditDescriptionRequest.php');
require_once(REQUESTS_PATH.'TopicCreateRequest.php');
require_once(REQUESTS_PATH.'TopicEditContentRequest.php');
require_once(REQUESTS_PATH.'TopicEditMediaRequest.php');
require_once(REQUESTS_PATH.'TopicEditNameRequest.php');
require_once(REQUESTS_PATH.'SubscriptionRequest.php');
require_once(REQUESTS_PATH.'TopicDeleteRequest.php');
require_once(REQUESTS_PATH.'UserEditEmailRequest.php');
require_once(REQUESTS_PATH.'UserEditNameRequest.php');
require_once(REQUESTS_PATH.'UserEditPasswordRequest.php');
require_once(REQUESTS_PATH.'UserEditPictureRequest.php');
require_once(REQUESTS_PATH.'PostCreateRequest.php');

// Global functions
require_once('globalFunctions.php');