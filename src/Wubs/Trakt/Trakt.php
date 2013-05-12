<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;

class Trakt{

	public static function get($string){
		$s = new Settings();
		$getList = explode('/', $string);
		$className = __NAMESPACE__;
		$count = count($getList);
		$func = end($getList);
		for ($i=0; $i < $count-1; $i++) {
				$name = ucfirst($getList[$i]); 
				$className .= '\\'.$name;
				if($i == $count-2){
					$className .= '\\'.$name;
				}
		}
		$class = new $className($s->get('trakt'));
		return $class->$func();
	}
}