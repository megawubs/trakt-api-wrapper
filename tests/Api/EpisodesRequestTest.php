<?php


use Illuminate\Support\Collection;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Trakt;

class EpisodesRequestTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testGetCommentsFromEpisode()
    {
        $trakt = new Trakt(mock_auth(), mock_client(
            200,
            '[
              {
                "id": 8,
                "parent_id": 0,
                "created_at": "2011-03-25T22:35:17.000Z",
                "comment": "Great episode!",
                "spoiler": false,
                "review": false,
                "replies": 1,
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
        ));

        $comments = $trakt->episodes->comments(8, 2, 1);

        $this->assertInstanceOf(Collection::class, $comments);
    }
}
