<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 19:01
 */

namespace Wubs\Trakt\Response;


use Carbon\Carbon;
use GuzzleHttp\ClientInterface;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\Comments\Delete;

class Comment
{
    private $clientId;

    private $json;

    public $id;

    public $parentId;

    public $createdAt;

    public $comment;

    public $spoiler;

    public $review;

    public $replies;

    public $likes;

    public $user;
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param $json
     * @param $clientId
     * @param ClientInterface $client
     */
    public function __construct($json, $clientId, ClientInterface $client)
    {
        $this->clientId = $clientId;
        $this->json = $json;

        $this->createdAt = Carbon::createFromFormat('Y-m-d\TH:i:s.uO', $json->created_at);
        $this->id = $json->id;
        $this->parent_id = $json->parent_id;
        $this->comment = $json->comment;
        $this->spoiler = $json->spoiler;
        $this->review = $json->review;
        $this->replies = $json->replies;
        $this->likes = $json->likes;
        $this->user = $json->user;
        $this->client = $client;
    }


    /**
     * @param AccessToken $token
     * @return bool
     */
    public function delete(AccessToken $token)
    {
        return (new Delete($token, $this->id))->make($this->clientId, $this->client);
    }


}