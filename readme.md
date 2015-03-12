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
or that request. This is the basis.

Currently I'm implementing all kinds of requests (only `GET` requests are supported for now). It's not hard to do 
this yourself

A request should extend the `AbstractRequest` class and implement the `AbstractRequest::getRequestType()` and 
`AbstractRequest::getUrl()`. Optionally you can override the `AbstractRequest::getResponseHandler()` to return the 
response handler. When you do not override the `AbstractRequest::getResponseHandler()` method, the 
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
        $this->setStartDate($startDate);
        $this->setDays($days);

        parent::__construct();
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUrl()
    {
        return "calendars/movies/" . $this->getStartDate() . "/" . $this->getDays();
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

$response = Movies::request($id, $token, StartDate::standard(), Days::num(1));
```

The `$response` variable will now contain the json response from the request.
 
If you want to manipulate the response before returning it from the `Movies::request()` method, you can create your 
own response handler by implementing the `Response` interface and write your manipulate code inside the 
`Response::handle(ResponseInterface $response)` method, where `ResponseInterface` is 
`GuzzleHttp\Message\ResponseInterface`

the `DefaultResponseHandler` looks like this:

``php

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


Feel free to contact me or help development :)

[oauth2-client]: https://github.com/thephpleague/oauth2-client
