<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 17:27
 */

namespace Wubs\Trakt\Request\Comments;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Media\Media;

class Comments
{
    private $id;
    /**
     * @var AccessToken
     */
    private $token;

    /**
     * @param $id
     * @param AccessToken $token
     */
    public function __construct($id, AccessToken $token)
    {

        $this->id = $id;
        $this->token = $token;
    }

    public function checkIn(Media $media)
    {
        return $media->checkIn($this->id, $this->token);
    }
}