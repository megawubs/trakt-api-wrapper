<?php
use Wubs\Trakt\Request\Comments\PostComment;
use Wubs\Trakt\Request\Parameters\Comment;
use Wubs\Trakt\Request\Parameters\Spoiler;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 16:10
 */
class PostCommentTest extends PHPUnit_Framework_TestCase
{

//    public function testStaticCall()
//    {
//        $id = get_client_id();
//        $token = get_token();
//
//        $movie = movie();
//
//        $result = PostComment::request($id, $token, $movie, Comment::set("It's a good movie, I really liked it!"));
//
//        $this->assertTrue($result);
//    }

    /**
     * @@expectedException Wubs\Trakt\Request\Exception\CommentTooShortException
     */
    public function testThrowsExceptionWithShoutLessThan5Words()
    {
        $id = get_client_id();
        $token = get_token();

        $movie = movie();

        $result = PostComment::request($id, $token, $movie, Comment::standard(), Spoiler::false());

        $this->assertTrue($result);
    }
}
