Trakt-api-wrapper version 2
=================

This is the Trakt API wrapper for their new API (version 2). It's in active development

## Installation

In your composer.json file add:`"wubs/trakt": "~2.0"` and run `composer install`

## The goal

The goal of this wrapper is to make communicating with the Trakt api easier. It aims to be easy, readable and usable in many cases. Designed as a composer package it can be easy installed inside a lager application.

## Laravel usage

To use the wrapper inside Laravel, you only have to add 
`Wubs\Trakt\Providers\Laravel\TraktApiServiceProvider::class` to the `providers` array in your `config/app.php` file.
 When you've done this, use the `\Wubs\Trakt\Trakt` class as a type hint to inject it into routes or methods. See 
 here an example:
 
 ```php
  Route::get(
     '/',
     function (\Wubs\Trakt\Trakt $trakt) {
         dump($trakt->movies->popular());
     }
 );
```

### Non Laravel Usage

If you don't use Laravel, you have to do a bit more to get it working.

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

To get your OAuth token, do the following after creating the `Trakt` object.

```PHP
<?php
$trakt->auth->authorize();
```
 
When you created the Auth object, you specified a redirect url. This is the url Trakt is going to redirect the user 
to, with an code you can use to obtain an access token. 

The moment you call `$trakt->auth->authorize();` the user will be directed to the authorization page of trakt.tv. After 
giving your application access to their account, Trakt redirects to the provided url, with a code. This code can than
 be used to obtain the access token. This can be done like so: `$trakt->auth->token($code);`
 
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

$auth = $trakt->auth->authorize();

//route: trakt/auth
$token = $trakt->auth->token($_GET['code']);
```

When you now go through the OAuth flow, you'll get your token (an instance of 
`League\OAuth2\Client\Token\AccessToken`) dumped out on the screen. Store the 
values from the token somewhere so you can recreate it later when the user needs it. You can do this by 
using `$trakt->auth->createToken()` and pass the required parameters `$token`, `$type`,`$expires`, 
`$refresh` and `$scope`. This wil return an instance of `League\OAuth2\Client\Token\AccessToken` which you can pass 
to methods that (optionally )require an token.

## Using the api wrapper

Now that you have the access token, you can use it to retrieve user-specific data from trakt.tv with the `Trakt` class.
  
```PHP
<?php

//initialize Auth here...

$trakt = new Trakt($auth);
$token = $trakt->auth->createToken($token, $type, $expires, $refresh, $scope);

$settings = $trakt->users->settings($token);
$comment = $trakt->comments->get($commentId);
$movie = $trakt->search->byId($type, $id);
$movie = $trakt->search->byId($type, $id, $token); //can be with, or without token.
```

### Pagination and Extended info

To utilise the extended info and pagination features, you have to set the page or extended info level before calling 
the endpoint. Here is an example:

```php
<?php
$trakt->movies->page(2)->collected(); //this will get the second page of the /movies/collected endpoint
//when you want to specify a limit
$trakt->movies->page(2)->limit(15)->collected(); //this will give you the second page, with 15 items
```

Extended info goes along the same way:
```php
<?php

$trakt->movies->withImages()->collected();//this will give you all kinds of extra images
//or
$trakt->movies->withFull()->collected(); //this will give you a lot of extra data
```

You can also combine all of this:

```php
<?php
$response = trakt->movies
    ->page(2)
    ->withImages()
    ->withFull()
    ->limit(20)
    ->collected();
    
```

The response will now be the second page of the `movies/collected` endpoint, with all images and all data limited to 
20 items per page.


Feel free to contact me or help development :)

[oauth2-client]: https://github.com/thephpleague/oauth2-client
