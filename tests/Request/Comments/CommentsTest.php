<?php
use Wubs\Trakt\Request\Comments\DeleteComment;
use Wubs\Trakt\Request\Parameters\Comment;
use Wubs\Trakt\Request\Parameters\CommentId;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 18:50
 */
class CommentsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var CommentId
     */
    private $commentId;

    public function testCanPostCommentFromMovieObject()
    {
        $movie = movie();

        $comment = $movie->comment(Comment::set("This is an amazing movie! I liked it so much :)"));

        $this->commentId = $comment->id;

        $this->assertInstanceOf("Wubs\\Trakt\\Response\\Comment", $comment);
        $this->assertInstanceOf("Wubs\\Trakt\\Parameters\\CommentId", $comment->id);
    }

    public function testCanDeleteCommentById()
    {
        $result = DeleteComment::request(get_client_id(), get_token(), $this->commentId);

        $this->assertTrue($result);
    }
}
