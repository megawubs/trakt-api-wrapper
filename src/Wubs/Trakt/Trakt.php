<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;

class Trakt{

	public static function get($request){
		$func = self::getFunc($request);
		return self::getClass($request)->$func();
	}

	public static function post($request, $params){
		$func = self::getFunc($request);
		return self::getClass($request, $params)->$func();
	}

	public static function getClass($request, $params = null){
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
		$class = new $className();
		return ($params == null ? $class : $class->setParams($params));
	}

	public static function getFunc($request){
		$getList = explode('/', $request);
		return end($getList);
	}
}