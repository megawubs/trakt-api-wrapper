<?php
use Wubs\Trakt\Request\CheckIn\CheckOut;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 15:52
 */
class CheckOutTest extends PHPUnit_Framework_TestCase
{

    public function testStaticCall()
    {
        $id = getenv("CLIENT_ID");
        $token = get_token();

        $response = CheckOut::request($id, $token);

        $this->assertTrue($response);
    }

}
