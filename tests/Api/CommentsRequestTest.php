<?php


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;
use Wubs\Trakt\Auth;
use Wubs\Trakt\Response\Comment;
use Wubs\Trakt\Trakt;

class CommentsRequestTest extends PHPUnit_Framework_TestCase
{


    protected function tearDown()
    {
        Mockery::close();
    }

    public function testCreateComment()
    {
        $client = mock_client(
            201,
            '{
              "id": 190,
              "parent_id": 0,
              "created_at": "2014-08-04T06:46:01.996Z",
              "comment": "Oh, I wasn\'t really listening.",
              "spoiler": false,
              "review": false,
              "replies": 0,
              "likes": 0,
              "user_rating": null,
              "user": {
                "username": "sean",
                "private": false,
                "name": "Sean Rudford",
                "vip": true,
                "vip_ep": false
              }
            }'
        );
        $auth = Mockery::mock(Auth::class);
//        $movieClient = mock_client(200, '[]');

        $trakt = new Trakt(get_client_id(), $client, $auth);

        $commend = $trakt->comments->create(movie($client), "This was so awesome! I really liked it!", false);
        $this->assertInternalType("object", $commend);
    }

    public function testDeleteComment()
    {
        $client = Mockery::mock(ClientInterface::class);
        $request = Mockery::mock(RequestInterface::class);
        $response = Mockery::mock(ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $client->shouldReceive("send")->once()->andReturn($response);
        $response->shouldReceive("getStatusCode")->twice()->andReturn(204);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(get_client_id(), $client, $auth);

        $this->assertTrue($trakt->comments->delete(get_token(), 190));

    }

    public function testGetCommentById()
    {

        $client = mock_client(
            204,
            '{
              "id": 1,
              "parent_id": 0,
              "created_at": "2010-11-03T06:30:13.000Z",
              "comment": "Agreed, this show is awesome. AMC in general has awesome shows.",
              "spoiler": false,
              "review": false,
              "replies": 1,
              "likes": 0,
              "user_rating": 8,
              "user": {
                "username": "justin",
                "private": false,
                "name": "Justin Nemeth",
                "vip": true,
                "vip_ep": false
              }
            }'
        );
        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(get_client_id(), $client, $auth);
        $comment = $trakt->comments->get(190);

        $this->assertInternalType("object", $comment);
    }

    public function testUpdateComment()
    {
        $client = mock_client(
            201,
            '{
    "comment": "Agreed, this show is awesome. AMC in general has awesome shows and I cant wait to see what they come ",
    "spoiler": false,
    "created_at": "2010-11-03T06:30:13.000Z",
    "review": false,
    "user_rating": null,
    "parent_id": 0,
    "likes": 0,
    "replies": 1,
    "id": 1,
    "user": {
        "username": "justin",
        "vip": true,
        "name": "Justin Nemeth",
        "private": false,
        "vip_ep": false
    }
}'
        );
        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(get_client_id(), $client, $auth);

        $commend = "Whuu, whaa blaaa, taduuuudoumwhoooom. I don't have any inspiration left!";
        $update = $trakt->comments->update(1, $commend, false);

        $this->assertInternalType("object", $update);
    }

    public function testLikeComment()
    {
        $client = Mockery::mock(ClientInterface::class);
        $request = Mockery::mock(RequestInterface::class);
        $response = Mockery::mock(ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $client->shouldReceive("send")->once()->andReturn($response);
        $response->shouldReceive("getStatusCode")->twice()->andReturn(204);
//        $response->shouldReceive("json")->once()->andReturn(json_decode($json));
        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(get_client_id(), $client, $auth);

        $this->assertTrue($trakt->comments->like(190));
    }

    public function testGetReplies()
    {
        $client = mock_client(
            201,
            '[
  {
    "id": 19,
    "parent_id": 1,
    "created_at": "2014-07-27T23:06:59.000Z",
    "comment": "Season 2 has really picked up the action!",
    "spoiler": true,
    "review": false,
    "replies": 0,
    "likes": 0,
    "user_rating": 8,
    "user": {
      "username": "sean",
      "private": false,
      "name": "Sean Rudford",
      "vip": true,
      "vip_ep": false
    }
  }
]'
        );
        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(get_client_id(), $client, $auth);

        $replies = $trakt->comments->replies(1);

        $this->assertInstanceOf(Collection::class, $replies);
        $this->assertInstanceOf(Comment::class, $replies->first());
    }

    public function testDeleteLike()
    {
        $client = Mockery::mock(ClientInterface::class);
        $request = Mockery::mock(RequestInterface::class);
        $response = Mockery::mock(ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $client->shouldReceive("send")->once()->andReturn($response);
        $response->shouldReceive("getStatusCode")->twice()->andReturn(204);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(get_client_id(), $client, $auth);

        $response = $trakt->comments->deleteLike(get_token(), 1);

        $this->assertTrue($response);
    }
}
