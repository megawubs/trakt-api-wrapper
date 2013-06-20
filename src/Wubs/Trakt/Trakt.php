<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;
use Wubs\Trakt\Exceptions\TraktException;
use Wubs\Trakt\HttpBot;

class Trakt{

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
	 * Gets the values for the parameter names you give it
	 * example: $params Trakt::getParams(array('username', 'password'));
	 * will return a valid json string that contains the username and password
	 * @param  array $params list of the parameters to get
	 * @return string         json string of the retrieved parameters
	 */
	public static function getParams(array$params){
		$returnParams = array();
		foreach ($params as $param) {
			$value = self::setting($param);
			if($param == 'password'){
				$value = sha1($value);
			}
			$returnParams[$param] = $value;
		}
		return json_encode($returnParams);
	}

	/**
	 * Shorthand for getting trakt related settings
	 * @param  string $string the name of the setting
	 * @return string         the value of the setting
	 */
	public static function setting($string){
		$s = new Settings();
		return $s->get('trakt.'.$string);
	}
	
	/**
	 * returns a new instance of HttpBot with the uri set
	 * @param  string $uri the uri call to make (without the format part)
	 * @return HttpBot         an intstance of HttpBot
	 */
	public function bot($uri){
		return new HttpBot($uri);
	}
}