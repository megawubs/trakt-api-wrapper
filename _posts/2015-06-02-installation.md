---
layout: page
title: "Installation"
category: setup
order: 1
date: 2015-06-02 12:56:28
---

__To be able to use this code inside your project, you first need a few things. If you are already familiar with 
composer you can skip this part.__
 
### Composer

First thing you need is Composer. To install it run the following command in your terminal `curl -sS 
https://getcomposer.org/installer | php` when you don't have curl installed run: `php -r "readfile
('https://getcomposer.org/installer');" | php`
 
This will output some information about the download process. When done, you can install it globally with the 
following command: `mv composer.phar /usr/local/bin/composer`

Now, when you type `composer` in your terminal you'll see some output telling you how to use composer. This is good, 
Composer is installed!

### Existing Project

When you already have an existing composer project, just type `composer require wubs/trakt dev-master` and let it 
install.

### Creating a new project

Next, you navigate to the folder you want to start your project using this wrapper. In that project execute the 
following command:

```bash
$ composer init
```

This wil initialize a new composer project for you and ask you a few questions. First it'll ask you about the Package
 name. Just make something op, the hint it gives is your username and the name of the folder. This will be good 
 enough most of the time. If you don't want to give it another name, just hit enter and fill in a short discription 
 of the project. If you can't come up with something, just hit enter again, its ok to leave it empty. The next you 
 can also hit enter (or specify another author name if you like). For Minimum Stability type `dev`, hit enter and add 
 the licence of your choice. 
  
  After doing all of this you'll be asked to add dependencies. Hit enter (the default is yes) and specify 
  `wubs/trakt` as the dependency. For the version constraint type `dev-master`. Add other dependency's if you like, 
  when done hit enter when asking for a new dependency. Do the same for `require-dev` packages. Next, review the 
  composer.json file that's going to be created. If you were following along, you should have something like this:
  
```JSON
 {
     "name": "vendor/project",
     "require": {
         "wubs/trakt": "dev-master"
     },
     "authors": [
         {
             "name": "John Doe",
             "email": "john@doe.com"
         }
     ],
     "minimum-stability": "dev",
     "autoload": {
         "psr-4": {
           "Vendor\\": "src/"
         }
       }
 }
```
   
Hit enter to confirm the creation of your composer.json file. This file describes all of your dependencies and the 
project you are creating.

Next, we can actually start downloading the dependencies by executing this command:

```BASH
$ composer install
```

This will show the install process. You'll see a few things you didn't specify in your composer.json file, that's ok,
 that are dependencies of your dependencies (inception anyone?).
 When everything is installed you should see a new folder called `vendor`. This is the place where all of the 
 dependencies defined in `composer.json` are located. You can browse the folder and see a few other folders, of which
  `wubs` is one. That's the one where the Trakt API library is in installed.

### Access the code

Now, you need a way to be able to use the API wrapper. This can be done fairly easy. Create a folder `src` in your 
directory and add an index.php file in it and paste the following code inside:

```PHP
<?php
require_once 'vendor/autoload.php'
```

This will include all the auto loading settings for each dependency you have installed!

If you want to include your own library inside the auto loading, visit [this][composer] url to read how it's done 
through Composer.

 


[composer]: https://getcomposer.org/doc/01-basic-usage.md#autoloading

 
 

