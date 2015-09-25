---
layout: page
title: "generator"
category: contribution
date: 2015-09-25 16:14:55
---

## Introduction
Contribution to this project is highly appreciated. You can add and change requests inside the `Wubs\Trakt\Requests` 
namespace. As explained earlier each request to the Trakt API is a class on it's own.
But to achieve the chained interface (`$trakt->users->settings();`) there needs to happen a bit of php magic before 
it actually works.

## The Trakt Class
Take a look at the `Wubs\Trakt\Trakt.php` file. This is the base file of the API wrapper. All a whole bunch of use 
statements for anything inside the `Wubs\Trakt\Api` namespace followed by a lot of public properties and finally the 
constructor that requires the `Wubs\Trakt\Auth` class and can be given a `ClientInterface`. And at the end of the 
constructor the `createWrappers()` method is called, that initiates all endpoints inside the `Wubs\Trakt\Api` 
namespace. But,  didn't we only create requests inside the `Wubs\Trakt\Requests` namespace? Why arn't they used 
here and where do the classes that are used here come from? I'll explain that here.

### The problems
With the approach of each request it's own class, I've made a system that's robust and easy to extend as a developer.
But what's a pain in the * is the usage of such a class. First of all, how does a consumer of this library know 
 about all possible requests if they are hidden away in a endless maze of namespaces? Here an example:
 
```PHP
<?php
use Wubs\Trakt\Request\Calendars\Shows;

$shows = new Shows();

$shows->make($clientId, $guzzleHttpClient);
```

The first problem with this code is it's readability. For now it's easy to guess what the `Shows` class is, but 
imagne this code to be on the 100th line of a class, you'll need a second to remember that this `Shows` class is a 
part of the Trakt API wrapper. Also, everywhere you call requests from the Trakt API Wrapper, you'll need to have 
your client id available and an instance of a guzzle http client. The last one is easily fixed by calling 
`TraktHttpClient::make();` but the other problems where way too inconvenient.

### The solution
That's why I decided to automatically generate a usable API for the consumer of this code, based on the existing 
request classes.

In short, this package is capable of reflecting all the request classes inside the `Wubs\Trakt\Request` namespace and
generate a nice and usable API from them. These generated classes are the classes under the `Wubs\Trakt\Api` 
namespace. The process is recursively, but more on that later. 

For example, the `Shows` request I just used becomes (after initiating the $trakt class):

``PHP
<?php
$shows = $trakt->calendars->shows();

```

Boom, just one line of code and i'ts intent is clear.

### Use the solution
When you add requests to this package, you probably are wondering how to add them to the `Wubs\Trakt\Trakt` class. 
This can be done by using the `bin/trakt` executable that's included. I'ts a simple php script that sets up a console
 application and adds one command; the `Wubs\Trakt\Console\TraktGenerateCommand`. This command generates the 
 chained API I described earlier. Execute it like this:
 
```BASH
$ bin/trakt wrapper:generate -f
```

Where the -f means force, this will overwrite any existing endpoints inside the `Wubs\Trakt\Api` namespace. And 
regenerate them based on the requests inside `Wubs\Trakt\Requests`. 

## How the generator works

The generator scans all folders inside the Requests folder. The folders it finds become the name of a new class it'll
generate. Each class it i'll find inside a folder will be a method on that class. This process works recursive. When
it encounters a folder within a folder, that folder will become a public property on the parent class, etc etc. An 
example of this is the `Wubs\Trakt\Request\Calendars\My` namespace. Inside this namespace there are a few classes, 
being `Movies`, `NewShows`, `Premieres` and `Shows`. The generator will first create the `Calendars` class, add a 
`$my` public property to it, generate the `My` class and add the methods `movies`, `newShows`, `Premieres` and 
`shows` to it with exact the same parameters as the corresponding classes. Inside the generated methods the actual 
`Request` object will be the initiated and run.  

