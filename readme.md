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
$provider = new Trakt($clientId, $clientSecret, $redirectUrl);
if (!isset($_GET['code'])) {
    $trakt->authorize();
}
elseif(empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])){
    $trakt->invalid()
}
else{
    $code = $_GET('code');
    $token = $trakt->getAccessToken($code)l
    //now store it somewhere safe.... yes, i said somewhere safe! 
}
```
 
Feel free to contact me or help development :)

[oauth2-client]: https://github.com/thephpleague/oauth2-client
