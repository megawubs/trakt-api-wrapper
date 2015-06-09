---
layout: default
title: "PHP Trakt API Wrapper"
---

### The Project

This Trakt PHP API library aims to make working with the Trakt API easy, expandable and robust. Each request is it's 
own class and each request can be handled by an given response handler.

### Code Examples

When set up, this wrapper lets you execute requests to the Trakt API with ease. See the examples below to get the 
general idea.

```PHP
<?php
use Wubs\Trakt\Request\Parameters\Query;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\Parameters\Year;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Request\Search\Text;

$parameters = [Query::set("guardians of the galaxy"), Type::movie(), Year::set("2014")];

$response = new Text::request($clientId, $token, $parameters); 

print_r($response) //the search results
        
```

For now, the wrapper is still undergoing high development. I'm still searching for the "right" way to create this 
wrapper. The current setup is rooted in the idea that every request is it's own object. This results in really 
declarative code, but in practice it's highly unusable and hard to master. This is why I'm currently thinking about 
merging this idea with another idea demonstrated below:
 
### Future idea:

```PHP
<?php

use Wubs\Trakt\Trakt;

$trakt = Trakt::api($key, $secret);

$popularMovies = $trakt->movies->popular();
$trendingMovies = $trakt->movies->trending();
$trendingMovies = $trakt->movies->updates($date);
$trendingMovies = $trakt->movies->get($traktIdOrTraktSlugOrImdbID);

$popularShows = $trakt->shows->popular();
$trendingShows ç= $trakt->shows->trending();
$trendingShows = $trakt->shows->updates($date);
$trendingShows = $trakt->shows->get($traktIdOrTraktSlugOrImdbID);

```

So, in the future all the request objects will be used by an easy to use interface, directly from the wrapper.