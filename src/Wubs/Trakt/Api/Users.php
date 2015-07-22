<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Wubs\Trakt\Api;

use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\Users\Collection as CollectionRequest;
use Wubs\Trakt\Request\Users\Comments as CommentsRequest;
use Wubs\Trakt\Request\Users\FollowRequests as FollowRequestsRequest;
use Wubs\Trakt\Request\Users\HiddenItems as HiddenItemsRequest;
use Wubs\Trakt\Request\Users\History as HistoryRequest;
use Wubs\Trakt\Request\Users\Likes as LikesRequest;
use Wubs\Trakt\Request\Users\Profile as ProfileRequest;
use Wubs\Trakt\Request\Users\Settings as SettingsRequest;

class Users extends Endpoint
{

    /**
     * @var \Wubs\Trakt\Api\Users\Follow
     */
    public $follow;

    /**
     * @var \Wubs\Trakt\Api\Users\Lists
     */
    public $lists;

    public function collection($username, $type, AccessToken $token = null)
    {
        return $this->request(new CollectionRequest($username, $type, $token));
    }

    public function comments($username, $commentType, $type, AccessToken $token)
    {
        return $this->request(new CommentsRequest($username, $commentType, $type, $token));
    }

    public function followRequests(AccessToken $token)
    {
        return $this->request(new FollowRequestsRequest($token));
    }

    public function hiddenItems(AccessToken $token, $section, $type)
    {
        return $this->request(new HiddenItemsRequest($token, $section, $type));
    }

    public function history($username, $type, AccessToken $token = null)
    {
        return $this->request(new HistoryRequest($username, $type, $token));
    }

    public function likes(AccessToken $token, $type)
    {
        return $this->request(new LikesRequest($token, $type));
    }

    public function profile($username, AccessToken $token = null)
    {
        return $this->request(new ProfileRequest($username, $token));
    }

    public function settings(AccessToken $token)
    {
        return $this->request(new SettingsRequest($token));
    }

}

