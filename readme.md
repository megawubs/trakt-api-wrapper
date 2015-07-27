Trakt-api-wrapper version 2
=================

This is the Trakt API wrapper for their new API (version 2). It's in active development

## Installation

In your composer.json file add:`"wubs/trakt": "dev-develop"` and run `composer install`

## The goal

The goal of this wrapper is to make communicating with the Trakt api easier. It aims to be easy, readable and usable in many cases. Designed as a composer package it can be easy installed inside a lager application.

## Instantiating the Trakt API Wrapper

The API Wrapper needs one dependency. The `Wubs\Trakt\Auth` class, that in turn depends on 
`Wubs\Trakt\Provider\TraktProvider` The `TraktProvider` holds your client id, secret and your redirect url. To make an 
Auth object:
 
 ```PHP
 <?php
 $provider = new TraktProvider($clientId, $clientSecret, $redirectUrl);
 $auth = new Auth($provider);
 ```

With this, you can create the `Trakt` class.

```PHP
$trakt = new Trakt($auth);
```

If you want to mock http request, you can give `Trakt` a second argument that must implement 
`GuzzleHttp\ClientInterface`. When you don't pass one, the real implementation is used to send requests to Trakt.

Once you've created the Trakt object, you should register it inside your IoC container, so you only have to write the
 code that instantiates the Trakt class once.

## OAuth

To get your OAuth token, do the following after creating the `Auth` object.

```PHP
<?php
$auth->authorize();
```
 
Wehn you created the Auth object, you specified a redirect url. This is the url Trakt is going to redirect the user 
to, with an code you can use to obtain an access token. 

The moment you call `$auth->authorize();` the user will be directed to the authorization page of trakt.tv. After 
giving your application access to their account, Trakt redirects to the provided url, with a code. This code can than
 be used to obtain the access token. This can be done like so: `$auth->token($code);`
 
But, when you don’t have a website running yet, you can’t specify a return url. To get the code displayed on the trakt
site, you need to tell Trakt that you want to redirect to them self and display the code you need to obtain an access 
token. You can do this by providing the following  string as redirect url: `urn:ietf:wg:oauth:2.0:oob`. This is only 
necessary when you have no local dev machine running.

So, lets say your client id is `12345678` and you client secret is `secret01` and we you a local dev machine with 
the host name`trakt.dev`. Now, you can set `trakt.dev/trakt/auth` as our redirect url. 

With this you can create a route from witch you do the following. Lets say it's your index route.

 ```PHP
<?php

//... initiate Auth

$auth = $trakt->authorize();

//route: trakt/auth
$token = $auth->token($_GET['code']);
```

When you now go through the OAuth flow, you'll get your token dumped out on the screen. Store the values from the 
token somewhere. With the values you can re-create the `AccessToken` when you need it by 
using the `\Wubs\Trakt\Auth\Token::create()` method and pass the required parameters `$token`, `$type` and`$expires`

## Using the api wrapper

Now that you have the access token, you can use it to retrieve user-specific data from trakt.tv with the `Trakt` class.

```PHP
<?php

// initiate Auth here

$trakt = new Trakt($auth);

$settings = $trakt->users->settings($token);
$comment = $trakt->comments->get($commentId);
$movie = $trakt->search->byId($type, $id);
$movie = $trakt->search->byId($type, $id, $token); //can be with, or without token.
```



Feel free to contact me or help development :)

[oauth2-client]: https://github.com/thephpleague/oauth2-client
