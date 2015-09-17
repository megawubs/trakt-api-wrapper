<?php


namespace Wubs\Trakt\Providers\Laravel\Facade;


use Illuminate\Support\Facades\Facade;

class Trakt extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'trakt';
    }
}