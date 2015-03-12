<?php
use Wubs\Trakt\Request\Comments\Replies;
use Wubs\Trakt\Request\Parameters\CommentId;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 13:02
 */
class RepliesTest extends PHPUnit_Framework_TestCase
{

    public function testStaticCall()
    {
        $id = getenv("CLIENT_ID");
        $token = get_token();

        $response = Replies::request($id, $token, CommentId::set(41));
        $this->assertInternalType("array", $response);
    }
}
