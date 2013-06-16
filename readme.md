Trakt-api-wrapper
=================

For one of my projects I have to communicate with the Trakt.tv api, I searched the web for a php api wrapper, but didn't find one. This is my attempt on building one.

## The goal

The goal of this wrapper is to make communicating with the Trakt api easier. It aims to me easy, readable and usable in many cases. Designed as a composer package it can be easy installed.

### Usage example

```PHP
/**
 * Post requests
 */

//getting the params from the settings using Wubs\Settings\Settings inside Trakt as json
$params = Trakt::getParams(array('username', 'password'));
//Retrieving account settings from trakt from the account stored in the settings.
$res = Trakt::post('account/settings', $params); //$res is now an array of the json response

/**
 * Get requests
 */
//getting http://api.trakt.tv/activity/community/ with no parameters
$res = Trakt::get('activity/community')->run(); //gets all activity

//getting http://api.trakt.tv/activity/community/ with parameters
$types = array('episode', 'show', 'list');
$actions = array('watching', 'scrobble', 'seen');
$res = Trakt::get('activity/community')
		->setTypes($types)
		->setActions($actions)
		->setStartDate('20130512')
		->setEndDate('20130614')
		->run();

```

## Note
It's still in development, please check back later.