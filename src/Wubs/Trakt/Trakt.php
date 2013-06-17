<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;

class Trakt{

	/**
	 * Maps a get request to the corresponding class and function
	 * @param  string $request a api get request sting, all api methods 
	 * can be found here: http://trakt.tv/api-docs
	 * @return mixed
	 */
	public static function get($request){
		$func = self::getFunc($request);
		return self::getClass($request)->$func();
	}

	/**
	 * Maps a post request, with the needed parameters
	 * to the corresponding class and function
	 * @param  string $request a api post request sting, all api methods 
	 * can be found here: http://trakt.tv/api-docs
	 * @return mixed
	 */
	public static function post($request){
		$func = self::getFunc($request);
		return self::getClass($request)->$func();
	}

	/**
	 * Parses the class name from the request string
	 * @param  string $request the request string
	 * @param  string $params  the params if it's a post request
	 * @return string          the name of the mapped class
	 */
	public static function getClass($request){
		$getList = explode('/', $request);
		$className = __NAMESPACE__;
		$count = count($getList);
		for ($i=0; $i < $count-1; $i++) {
			$name = ucfirst($getList[$i]); 
			$className .= '\\'.$name;
			if($i == $count-2){
				$className .= '\\'.$name;
			}
		}
		return new $className();
	}

	/**
	 * Parses the function name from the request
	 * @param  string $request the api request
	 * @return string          the name of the function
	 */
	public static function getFunc($request){
		$getList = explode('/', $request);
		return end($getList);
	}

	/**
	 * Gets the values for the parameter names you give it
	 * example: $params Trakt::getParams(array('username', 'password'));
	 * will return a valid json string that contains the username and password
	 * @param  array $params list of the parameters to get
	 * @return string         json string of the retrieved parameters
	 */
	public static function getParams(array$params){
		$s = new Settings();
		$returnParams = array();
		foreach ($params as $param) {
			$value = $s->get('trakt.'.$param);
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
}