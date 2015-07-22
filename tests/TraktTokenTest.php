<?php
use Wubs\Trakt\Auth\Token;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/02/15
 * Time: 15:00
 */
class TraktTokenTest extends PHPUnit_Framework_TestCase
{


    public function testTokenCanBeCreated()
    {
        $token = Token::create(
            getenv("TRAKT_ACCESS_TOKEN"),
            getenv("TRAKT_TOKEN_TYPE"),
            getenv("TRAKT_EXPIRES_IN"),
            getenv("TRAKT_REFRESH_TOKEN"),
            getenv("TRAKT_SCOPE")
        );

        $this->assertEquals(getenv("TRAKT_ACCESS_TOKEN"), $token->accessToken);
        $this->assertEquals(time() + ((int)getenv("TRAKT_EXPIRES_IN")), $token->expires);
        $this->assertEquals(getenv("TRAKT_REFRESH_TOKEN"), $token->refreshToken);
    }
}
