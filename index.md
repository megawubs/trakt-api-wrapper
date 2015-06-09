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


```
$parameters = [Query::set("guardians of the galaxy"), Type::movie(), Year::set("2014")];

$response = new Text::request($clientId, $token, $parameters); 

print_r($response) //the search results
        
```