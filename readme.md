Trakt-api-wrapper
=================

For one of my projects I have to communicate with the Trakt.tv api, I searched the web for a php api wrapper, but didn't find one. This is my attempt on building one.

## The goal

The goal of this wrapper is to make communicating with the Trakt api easier. It aims to be easy, readable and usable in many cases. Designed as a composer package it can be easy installed inside a lager application.

### Usage examples

__Post request__
```PHP
//getting the params from the settings using Wubs\Settings\Settings inside Trakt as json
$params = Trakt::getParams(array('username', 'password'));
//Retrieving account settings from trakt from the account stored in the settings.
$res = Trakt::post('account/settings')->setParams($params)->run(); //$res is now an array of the json response
```
__Post request with custom parameters__

```PHP
$user = 'megawubs';
$password = sha1('mysupersecretpassword');
$params = array('username'=>$user, 'password'=>$password, 'tvdb_id'=>205281,'title'=>'Falling Skies', 'year' => 2011, 'comment' => 'It has grown into one of my favorite shows!');
$res = Trakt::post('comment/show')->setParams($params)->run();
```

__Get request__


```PHP
//getting http://api.trakt.tv/activity/community/ with no parameters
$res = Trakt::get('activity/community')->run(); //gets all activity

//getting http://api.trakt.tv/activity/community/ with parameters
$types = 'episode, show, list';
$actions = 'watching, scrobble, seen';
$res = Trakt::get('activity/community')->setTypes($types)
		->setActions($actions)
		->setStartDate(strtotime('20130512'))
		->setEndDate(strtotime('20130614'))
		->run();
```

## Todo's

Finish implementing all api requests and the corresponding tests

Create `Wubs\Trakt\Movie`, `Wubs\Trakt\Show`, `Wubs\Trakt\Episode` and `Wubs\Trakt\User` classes that will wrap a lot of `Trakt::get()` and `Trakt::post()` functions together

__Preview__ 

This is how I think it'll be implemented:
```PHP
//initiate the movie
$movie = Trakt::movie('slug/IMDB ID or TMDB ID');

//some actions
$success = $movie->checkin();
$success = $movie->cancleCheckin();
$success = $movie->addToWatchlist();
$success = $movie->addToList('list name');

//a way to get info
$watchers = $movie->getWatchingNow();
$comments = $movie->getComments();
```
## Note
Development is going fast at the moment. The current working api calls are in the TraktUriOrder.php file. Not all calls are implemented and/or tested yet.

Feel free to contact me or help development :)

