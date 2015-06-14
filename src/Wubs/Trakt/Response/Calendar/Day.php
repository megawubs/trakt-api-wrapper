<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 17:12
 */

namespace Wubs\Trakt\Response\Calendar;


use Carbon\Carbon;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Media\Show;
use Wubs\Trakt\Request\Parameters\Type;

class Day
{

    /**
     * @var Carbon
     */
    public $date;

    /**
     * @var Media[]
     */
    public $releases = [];
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
     * @param $date
     * @param $items
     * @param Type $type
     * @param ClientId $id
     * @param AccessToken $token
     */
    public function __construct($date, $items, Type $type, ClientId $id, $token)
    {
        $this->id = $id;
        $this->token = $token;
        $this->type = $type;

        $this->setDate($date);
        $this->setReleases($items);

    }

    /**
     * @param $date
     * @return void
     */
    private function setDate($date)
    {
        $this->date = Carbon::createFromFormat("Y-m-d\\TH:i:s.uO", $date, new \DateTimeZone("GMT"));
    }

    /**
     * @param $items
     */
    private function setReleases($items)
    {
        foreach ($items as $item) {
            if ($this->type == Type::movie()) {
                $this->releases[] = new Movie($item, $this->id, $this->token);
            }
            if ($this->type == Type::show()) {
                $this->releases[] = new Show($item, $this->id, $this->token);
            }
        }
    }
}