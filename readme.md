Trakt-api-wrapper version 2
=================

This is the Trakt API wrapper for their new API (version 2). It's in active development

## The goal

The goal of this wrapper is to make communicating with the Trakt api easier. It aims to be easy, readable and usable in many cases. Designed as a composer package it can be easy installed inside a lager application.

### Usage examples

__setup__

Before you can use the API Wrapper, you need to obtain a OAuth Access token. To be able to do this, you can use the 
`TraktProvider` class. For more, detailed information on how to use the `TraktProvider` see [here][oauth2-client].

A basic example:

```PHP
<?php
$provider = new TraktProvider();
if (!isset($_GET['code'])) {
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->state;
    header("location: $authUrl");
}
elseif(empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])){
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
}
else{
    $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
    //now store it somewhere safe.... yes, i said somewhere safe! 
}
```

The api of trakt, just as everything else on the world wide web, changes over time. Currently, this means that when something changes on the api, i have to add these changes to the TraktUriOrder list. 

Feel free to contact me or help development :)

[oauth2-client]: https://github.com/thephpleague/oauth2-client
