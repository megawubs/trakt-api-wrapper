Trakt-api-wrapper version 2
=================

This is the Trakt API wrapper for their new API (version 2). It's in active development

## The goal

The goal of this wrapper is to make communicating with the Trakt api easier. It aims to be easy, readable and usable in many cases. Designed as a composer package it can be easy installed inside a lager application.

### Usage examples

__setup__

Before you can use the API Wrapper, you need to obtain a OAuth Access token. To be able to do this we internally use 
[oauth2-client][oauth2-client].
A basic example of how to obtain a token with this wrapper:

```PHP
<?php
$trakt = new Trakt($clientId, $clientSecret, $redirectUrl);
if (!isset($_GET['code'])) {
    $trakt->authorize();
}
else{
    $code = $_GET('code');
    $token = $trakt->getAccessToken($code);
    //now store it somewhere safe.... yes, i said somewhere safe! 
}
```

## The inner workings

This updated wrapper is in many ways different from the previous version. Inspired by other contributors I decided to
 follow a more Object Oriented approach. Each request is a object on its own, and can have a response handler just 
 for that request. This is the basis.
 
A simple `calendars/shows` request is prefomred like so:

```php
use Wubs\Trakt\Request\Calendars\Shows;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Token\TraktAccessToken;

$id = getenv("CLIENT_ID");

// this is the access code, unique for each user! Below is the code for when you just use it for yourself.
$token = TraktAccessToken::create(
                getenv("TRAKT_ACCESS_TOKEN"),  
                getenv("TRAKT_TOKEN_TYPE"),
                getenv("TRAKT_EXPIRES_IN"),
                getenv("TRAKT_REFRESH_TOKEN"),
                getenv("TRAKT_SCOPE")
            );

$response = Shows::request($id, $token, StartDate::standard(), Days::num(1));
```
Feel free to contact me or help development :)

[oauth2-client]: https://github.com/thephpleague/oauth2-client
