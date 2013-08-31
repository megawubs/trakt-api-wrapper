<?php namespace Wubs\Trakt\Media;


use Wubs\Trakt\Base\TraktClass;

class Media extends TraktClass{

	public function __construct($identifier){
		if(is_string($identifier)){
			if(!strstr($identifier, '-')){
				$identifier = str_replace(' ', '-', $identifier);
			}
		}
		$this->identifier = $identifier;
	}
}