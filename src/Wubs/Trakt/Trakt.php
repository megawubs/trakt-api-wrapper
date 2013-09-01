<?php namespace Wubs\Trakt;

use Wubs\Trakt\Exceptions\TraktException;
use Wubs\Trakt\Base\HttpBot;
use Wubs\Trakt\User;
use Wubs\Trakt\Media\Show;

class Trakt{

	public static $api;

	public static $version = '0.1';

	/**
	 * Return a new show object
	 * @param  mixed $identifier Either the slug (i.e. the-walking-dead) or TVDB ID.
	 * @return Wubs\Trakt\Show             The show data mapped as a object
	 */
	public static function show($identifier){
		return new Show($identifier);
	}

	/**
	 * Create a new trakt user object
	 * @param  string $name A username from tratk.tv
	 * @return Wubs\Trakt\User       A object containing the user data;
	 */
	public static function user($name, $password){
		return new User($name, $password);
	}
	
	/**
	 * Maps a get request to the corresponding class and function
	 * @param  string $request a api get request sting, all api methods 
	 * can be found here: http://trakt.tv/api-docs
	 * @return HttpBot
	 */
	public static function get($request){
		return self::bot($request)->setHTTPType('get');
	}

	/**
	 * Maps a post request to the corresponding class and function
	 * @param  string $request a api post request sting, all api methods 
	 * can be found here: http://trakt.tv/api-docs
	 * @return mixed
	 */
	public static function post($request){
		return self::bot($request)->setHTTPType('post');
	}

	/**
	 * Sets the api key for trakt
	 * @param string $key your trakt api key (see your account to find it)
	 */
	public static function setApiKey($key){
		self::$api = $key;
	}
	
	/**
	 * returns a new instance of HttpBot with the uri set
	 * @param  string $uri the uri call to make (without the format part)
	 * @return HttpBot         an intstance of HttpBot
	 */
	public function bot($uri){
		return new HttpBot($uri, self::$api);
	}
}