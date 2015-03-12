<?php
use Wubs\Trakt\Request\Comments\Comment;
use Wubs\Trakt\Request\Parameters\CommentId;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 12:54
 */
class CommentTest extends PHPUnit_Framework_TestCase
{
    public function testStaticCall()
    {
        $id = getenv("CLIENT_ID");
        $token = get_token();

        $response = Comment::request($id, $token, CommentId::set(41));
        $this->assertInternalType("array", $response);
    }
}
