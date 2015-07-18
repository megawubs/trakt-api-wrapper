<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 18:48
 */

namespace Wubs\Trakt\Response\Calendar;


use GuzzleHttp\ClientInterface;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Request\Parameters\Type;

class Calendar
{

    /**
     * @var Day[]
     */
    public $days = [];
    /**
     * @var integer
     */
    private $id;
    /**
     * @var AccessToken
     */
    private $token;
    /**
     * @var Type
     */
    private $type;
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param $json
     * @param Type $type
     * @param $id
     * @param AccessToken $token
     */
    public function __construct($json, Type $type, $id, $token, ClientInterface $client)
    {
        $this->id = $id;
        $this->token = $token;
        $this->type = $type;
        $this->client = $client;

        $this->setDays($json);

    }

    /**
     * @param $json
     * @return Day[]
     */
    private function setDays($json)
    {
        foreach ($json as $date => $movies) {
            $this->days[] = new Day($date, $movies, $this->type, $this->id, $this->token, $this->client);
        }
    }
}