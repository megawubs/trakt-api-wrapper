<?php
use Wubs\Trakt\Request\Comments\GetComment;
use Wubs\Trakt\Request\Parameters\CommentId;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 12:54
 */
class GetCommentTest extends PHPUnit_Framework_TestCase
{
    public function testStaticCall()
    {
        $id = get_client_id();
        $token = get_token();

        $response = GetComment::request($id, $token, CommentId::set(41));
        $this->assertInternalType("array", $response);
    }
}
