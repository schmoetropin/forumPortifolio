<?php
declare(strict_types=1);

use Src\Core\Session;
use Src\Code\Controllers\ModeratorController;
use Src\Code\Controllers\UserController;
use Src\Code\Controllers\SubscriptionController;
use Src\Code\Controllers\CommunityController;

/**
 * @param string $key
 * @return string
 */
function session(string $key)
{
    $sess = new Session();
    return $sess->getSession($key);
}

/**
 * @param string $moderator
 * @param int $community
 * @return bool
 */
function checkIfUserModeratesCommunity(int $moderator, int $community): bool
{
    $modCon = new ModeratorController();
    return $modCon->checkUserModeratesCommunity($moderator, $community);
}

/**
 * @param int $id
 * @return string
 */
function getUserUniqueName(int $id): string
{
    $usCon = new UserController();
    return $usCon->getUniqueName($id);
}

function getUserId(string $uniqueName): int
{
    $usCon = new UserController();
    return $usCon->getId($uniqueName);
}

/**
 * @param int $id
 * @return string
 */
function getUserName(int $id): string
{
    $usCon = new UserController();
    return $usCon->getName($id);
}

/**
 * @param int $id
 * @return string
 */
function getUserProfilePic(int $id): string
{
    $usCon = new UserController();
    return $usCon->getProfilePic($id);
}

/**
 * @param int $user
 * @param int $community
 * @return bool
 */
function checkUserSubscription(int $user, int $community): bool
{
    $subCon = new SubscriptionController();
    return $subCon->checkUserSubscription($user, $community);
}

/**
 * @param int $id
 * @return string
 */
function getCommunityUniqueName(int $id): string
{
    $comCon = new CommunityController();
    return $comCon->getUniqueName($id);
}

function getCommunityName(int $id): string
{
    $comCon = new CommunityController();
    return $comCon->getName($id);
}

function getCommunityPicture(int $id): string
{
    $comCon = new CommunityController();
    return $comCon->getCommunityPicture($id);
}

function getCommunityDescription(int $id): string
{
    $comCon = new CommunityController();
    return $comCon->getDescription($id);
}