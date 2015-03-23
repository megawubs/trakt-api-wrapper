<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 18:48
 */

namespace Wubs\Trakt\Response\Calendar;


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
     * @var ClientId
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
     * @param $json
     * @param Type $type
     * @param ClientId $id
     * @param AccessToken $token
     */
    public function __construct($json, Type $type, ClientId $id, AccessToken $token)
    {
        $this->id = $id;
        $this->token = $token;
        $this->type = $type;

        $this->setDays($json);
    }

    /**
     * @param $json
     * @return Day[]
     */
    private function setDays($json)
    {
        foreach ($json as $date => $movies) {
            $this->days[] = new Day($date, $movies, $this->type, $this->id, $this->token);
        }
    }
}