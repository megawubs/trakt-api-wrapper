Trakt-api-wrapper
=================

For one of my projects I have to communicate with the Trakt.tv api, I searched the web for a php api wrapper, but didn't find one. This is my attempt on building one.

## The goal

The goal of this wrapper is to make communicating with the Trakt api easier. It aims to be easy, readable and usable in many cases. Designed as a composer package it can be easy installed inside a lager application.

### Usage examples

__setup__

As of now, the api wrapper doesn't use a settings file. Only for the require-dev is a settings library included. This means that you need to provide the wrapper with you api key before you start using it. This is done like so:

```PHP
Trakt::setApiKey('your-api-key');

//continue to use the trakt-api library
```

__Post request__
```PHP
//setting the required parameters
$params = array('username'=>'john', 'password'=>sha1('ilovejane'));
//Retrieving account settings from trakt 
$res = Trakt::post('account/settings')->setParams($params)->run(); //$res is now an array of the json response
```
__Another post request__

```PHP
$user = 'jane';
$password = sha1('ilovejohn');
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

## Doing right now:

As for a time now, i'm done with writing the core and started on writing some wrapper classes/methods for common usage.

__Preview__ 

This is what I'm currently trying to create:

```PHP
//initiate the movie
$movie = Trakt::movie('riddick-2013'); //can be TVDB id or slug

//some actions
$success = $movie->checkin();
$success = $movie->cancleCheckin();
$success = $movie->addToWatchlist();
$success = $movie->addToList('list-name'); //slug of the list name

//a way to get info
$watchers = $movie->getWatchingNow();
$comments = $movie->getComments();
```
## Note
The api of trakt, just as everything else on the world wide web, changes over time. Currently, this means that when something changes on the api, i have to add these changes to the TraktUriOrder list. 

Feel free to contact me or help development :)

