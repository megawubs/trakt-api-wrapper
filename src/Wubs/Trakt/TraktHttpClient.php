<?php


namespace Wubs\Trakt;


use GuzzleHttp\Client;

class TraktHttpClient
{

    const API_URL = 'api-v2launch.trakt.tv';

    const API_VERSION = 2;

    const API_SCHEME = 'https';

    public static function make()
    {
        $host = static::API_URL;

        return new Client(['base_url' => [static::API_SCHEME . '://' . $host, ['version' => static::API_VERSION]]]);
    }
}