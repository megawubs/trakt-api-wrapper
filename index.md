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

$trakt->movies->popular(); // get all popular movies
$trakt->movies->withFull()->popular(); //get all popular movies with extended info
$trakt->users->followers->approve($token, $requestId); //approve a friend request

//search and check in to an item.
$media = $trakt->search->byText("Transformers", Type::movie(), 2007, $token);
$trakt->checkIn->create($token, $media->first());

//cancle the checkin
$trakt->checkIn->delete($token);
        
```