<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 01/03/15
 * Time: 22:52
 */

namespace Wubs\Trakt\Media;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;

class Episode extends Media
{

    protected $airsAt;

    protected $season;

    protected $number;

    protected $title;

    protected $ids = [];

    /**
     * @var Show
     */
    protected $show;

    public function __construct($json, ClientId $clientId, AccessToken $token)
    {
        parent::__construct($json, $clientId, $token);

        $this->airsAt = $json->airs_at;
        $this->season = $json->episode->season;
    }

    public function getTitle()
    {
        // TODO: Implement getTitle() method.
    }

    public function getIds()
    {
        // TODO: Implement getIds() method.
    }
}