---
layout: page
title: "Generator"
category: documentation
order: 3
date: 2015-09-25 16:14:55
---

## Introduction
If you want to contribute to this project, or you want to understand a bit more of how one specific part of it works,
read on! As you might know, the request objects are located inside the `Wubs\Trakt\Requests` namespace. As explained 
each request to the Trakt API is a class on it's own.
But to achieve the chained interface (`$trakt->users->settings();`) there needs to happen a bit of magic before 
it actually works.

## The Trakt Class
Take a look at the `Wubs\Trakt\Trakt.php` file. This is the base file of the API wrapper. A whole bunch of use 
statements for classes inside the `Wubs\Trakt\Api` namespace followed by a lot of public properties and finally the 
constructor that requires the `Wubs\Trakt\Auth` class and can be given a `ClientInterface`. And at the end of the 
constructor the `createWrappers()` method is called, that initiates all endpoints inside the `Wubs\Trakt\Api` 
namespace. But, didn't I just said all request objects are located inside the `Wubs\Trakt\Request` namespace? Why aren't 
they used here and where do the classes that are used come from? I'll explain that in this document.

### The problems
With the approach of each request it's own class, I've made a system that's robust and easy to extend as a developer 
of the library. But what's a pain in the ass is the usage of such a system. First of all, how does a consumer of this 
library know about all possible requests if they are hidden away in a endless maze of namespaces? Here an example:
 
```PHP
<?php
use Wubs\Trakt\Request\Calendars\Shows;

$shows = new Shows();

$shows->make($clientId, $guzzleHttpClient);
```

The first problem with this code is it's readability. For now it's easy to guess what the `Shows` class is, but 
imagine this code to be on the 100th line of a class, you'll need a second to remember that this `Shows` class is a 
part of the Trakt API wrapper. Also, everywhere you call requests from the Trakt API Wrapper, you'll need to have 
your client id available and an instance of a guzzle http client. The last one is easily fixed by calling 
`TraktHttpClient::make();` but the other problems where way too inconvenient. That's why I've created the generator.

### The solution
The generator automatically generates a usable API for the consumer of this code, based on the existing 
request classes.

In short, this package is capable of reflecting all the request classes inside the `Wubs\Trakt\Request` namespace and
generate a nice and usable API from them. These generated classes are the classes under the `Wubs\Trakt\Api` 
namespace. The process is recursively, but more on that later. 

For example, the `Shows` request I just mentioned becomes (after initiating the $trakt class):

```PHP
<?php
$shows = $trakt->calendars->shows();

```

Boom, just one line of code and it's intent is clear.

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

The generator scans all folders inside the Requests folder. When it encounters a folder it becomes the name of a 
new class. Each class it'll find inside a folder will be a method on that class. This process works 
recursive, meaning that when it encounters a folder within a folder, that folder will become a new class and a public 
property on the parent class, with the classes inside that folder as methods on the new class, etc etc. An example of 
this is the `Wubs\Trakt\Request\Calendars\My` namespace. Inside this namespace there are a few classes, being 
`Movies`, `NewShows`, `Premieres` and `Shows`. The 
generator will first create the `Calendars` class, add a `$my` public property to it, generate the `My` class and add the 
methods `movies`, `newShows`, `Premieres` and `shows` to it. Inside the generated methods the actual Request 
object will be the initiated and run.

