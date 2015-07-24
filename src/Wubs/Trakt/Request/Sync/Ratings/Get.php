<?php


namespace Wubs\Trakt\Request\Sync\Ratings;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Get extends AbstractRequest
{
    /**
     * @var null
     */
    private $rating;
    /**
     * @var
     */
    private $type;

    /**
     * @param AccessToken $token
     * @param $type
     * @param null $rating
     */
    public function __construct(AccessToken $token, $type, $rating = null)
    {
        parent::__construct();
        $this->setToken($token);
        $this->rating = $rating;
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return null
     */
    public function getRating()
    {
        return $this->rating;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return (!is_null($this->rating))
            ? "sync/ratings/:type/:rating"
            : "sync/ratings/:type";
    }
}