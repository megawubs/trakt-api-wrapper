Trakt-api-wrapper version 2
=================

This is the Trakt API wrapper for their new API (version 2). It's in active development

## Installation

In your composer.json file add:`"wubs/trakt": "dev-master"` and run `composer install`

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
using the `TraktAccessToken::ceate()` method and pass the required parameters `$token`, `$type` and`$expires`

## Using the api wrapper

Now that you have the access token, you can use it to retrieve user-specific data from trakt.tv with the `Trakt` class.

```PHP
<?php

// initiate Auth here

$trakt = new $trakt($auth);




This updated wrapper is in many ways different from the previous version. Inspired by other contributors I decided to
follow a more Object Oriented approach. Each request is a object on its own, and can have a response handler just 
or that request. This is the basis.

Currently I'm implementing all kinds of requests. It's not hard to do this yourself.

A request should extend the `AbstractRequest` class and implement the `AbstractRequest::getRequestType()` and 
`AbstractRequest::getUrl()`. methods To set the response handler use `AbstractRequest::setResponseHandler(new 
MyHandler())` inside the constructor of the request object. When you do not set the a handler the
`DefaultResponseHandler` will be used. 

The basics of a `Request` object will look like this.
```php
<?php

namespace Wubs\Trakt\Request\Calendars;

use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Movies extends AbstractRequest
{
    public function getRequestType()
    {
        return RequestType::GET;
    }
    public function getUrl()
    {
        return "calendars/movies/"
    }
}
```

Only, we don't have any way of passing the required parameters to the url. For the request class above this are a 
start date the number of days. These parameters are also wrapped in their own classes.

A parameter is just a representation of the value that is required. For example, the `StartDate` parameter ensures a 
format of `Y-m-d` when it's converted to a string. Also, a parameter should implement the `Parameter`  
implement the `Parameter` interface. 
    
For all requests that need a `StartDay` and a `Day` parameter, there is the `TimePeriod` trait that handles the 
assigning. wWhen there are no parameters provided it sets the standard value, as provided by the `Parameter::standard
()` method.

Now, the above class can be updated to use the `Parameter` classes.

```PHP
<?php

namespace Wubs\Trakt\Request\Calendars;

use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Request\TimePeriod;

class Movies extends AbstractRequest
{
    
    use TimePeriod;

    public function __construct(StartDate $startDate = null, Days $days = null)
    {
        parent::__construct();
        
        $this->setStartDate($startDate);
        $this->setDays($days);
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUrl()
    {
        return "calendars/movies/:start_date/:days";
    }
}
```
 
A simple `calendars/movies` request can now preformed like so:

```php
<?php

use Wubs\Trakt\Request\Calendars\Movies;
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
$parameters = [StartDate::standard(), Days::num(1)];

$response = Movies::request($id, $token, $parameters); //the parameters will be passed through to the request object
```

The `$response` variable will now contain the json response from the request.
 
If you want to manipulate the response before returning it from the `Movies::request()` method, you can create your 
own response handler by implementing the `Response` interface and write your manipulate code inside the 
`Response::handle(ResponseInterface $response)` method, where `ResponseInterface` is 
`GuzzleHttp\Message\ResponseInterface`

the `DefaultResponseHandler` looks like this:

```php

<?php

namespace Wubs\Trakt\Response;


use GuzzleHttp\Message\ResponseInterface;

class DefaultResponseHandler implements Response
{
    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function handle(ResponseInterface $response)
    {
        return $response->json();
    }
}
```

You can create your own response handler, just extend `AbstractResponseHandler` and implement the `ResponseHandler` 
interface.

When calling a request statically the response handler can be passed after the request parameters like so:
 
 ```PHP
 <?php
 use Wubs\Trakt\Request\Calendars\Movies;
 
 class MyResponseHandler extends AbstractResponseHandler implements ResponseHandler
 {
 
     public function handle(ResponseInterface $response)
     {
         return true;
     }
 }
 
 $parameters = [StartDate::standard(), Days::num(1)];
 $response = Movies::Movies::request(get_client_id(), get_token(), $parameters, new MyResponseHandler());
 
 print_r($response); //true
 ```
 
When you build the request yourself, it can be set with `$request->setResponseHandler(new MyResponseHandler())`

Feel free to contact me or help development :)

[oauth2-client]: https://github.com/thephpleague/oauth2-client
