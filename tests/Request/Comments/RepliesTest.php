<?php
use Wubs\Trakt\Request\Comments\Replies;
use Wubs\Trakt\Request\Parameters\CommentId;
use Wubs\Trakt\Request\RequestType;

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

        $request = new Replies(CommentId::set(41));

        $this->assertEquals("comments/41/replies", $request->getUrl());

        $this->assertEquals(RequestType::GET, $request->getRequestType());
    }
}
