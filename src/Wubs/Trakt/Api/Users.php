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
use Wubs\Trakt\Request\Users\Follow as FollowRequest;
use Wubs\Trakt\Request\Users\Following as FollowingRequest;
use Wubs\Trakt\Request\Users\Friends as FriendsRequest;
use Wubs\Trakt\Request\Users\Hidden as HiddenRequest;
use Wubs\Trakt\Request\Users\History as HistoryRequest;
use Wubs\Trakt\Request\Users\Likes as LikesRequest;
use Wubs\Trakt\Request\Users\Profile as ProfileRequest;
use Wubs\Trakt\Request\Users\Ratings as RatingsRequest;
use Wubs\Trakt\Request\Users\Settings as SettingsRequest;
use Wubs\Trakt\Request\Users\Stats as StatsRequest;
use Wubs\Trakt\Request\Users\Watching as WatchingRequest;
use Wubs\Trakt\Request\Users\Watchlist as WatchlistRequest;

class Users extends Endpoint {
    
    /**
     * @var \Wubs\Trakt\Api\Users\Followers
    */
    public $followers;

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

	public function follow(AccessToken $token, $username)
    {
        return $this->request(new FollowRequest($token, $username));
    }

	public function following($username, AccessToken $token = null)
    {
        return $this->request(new FollowingRequest($username, $token));
    }

	public function friends($username, AccessToken $token)
    {
        return $this->request(new FriendsRequest($username, $token));
    }

	public function hidden(AccessToken $token, $section, $type)
    {
        return $this->request(new HiddenRequest($token, $section, $type));
    }

	public function history($username, $type = null, $id = null, AccessToken $token = null)
    {
        return $this->request(new HistoryRequest($username, $type, $id, $token));
    }

	public function likes(AccessToken $token, $type)
    {
        return $this->request(new LikesRequest($token, $type));
    }

	public function profile($username, AccessToken $token = null)
    {
        return $this->request(new ProfileRequest($username, $token));
    }

	public function ratings($username, $type, $rating = null, AccessToken $token = null)
    {
        return $this->request(new RatingsRequest($username, $type, $rating, $token));
    }

	public function settings(AccessToken $token)
    {
        return $this->request(new SettingsRequest($token));
    }

	public function stats($username, AccessToken $token = null)
    {
        return $this->request(new StatsRequest($username, $token));
    }

	public function watching($username, AccessToken $token = null)
    {
        return $this->request(new WatchingRequest($username, $token));
    }

	public function watchlist($username, $type = null, AccessToken $token = null)
    {
        return $this->request(new WatchlistRequest($username, $type, $token));
    }

}

