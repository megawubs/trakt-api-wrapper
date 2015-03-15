<?php
use Carbon\Carbon;
use Wubs\Trakt\Request\Calendars\Shows\Premieres;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 12:35
 */
class PremieresTest extends PHPUnit_Framework_TestCase
{

    public function testStaticCall()
    {
        $id = get_client_id();
        $token = get_token();

        $response = Premieres::request($id, $token, new StartDate(Carbon::now()->subYears(3)), Days::set(500));
        $this->assertInstanceOf("Wubs\\Trakt\\Media\\Episode", $response[0]);
    }
}
