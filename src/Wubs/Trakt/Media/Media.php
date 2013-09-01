<?php namespace Wubs\Trakt\Media;


use Wubs\Trakt\Base\TraktClass;
use Wubs\Trakt\User;

class Media extends TraktClass{

	public $user;

	protected $identifier;

	public function __construct($identifier){
		// parent::__construct();
		$this->setIdentifier($identifier);
	}

	private function setIdentifier($identifier){
		if(is_string($identifier)){
			if(!strstr($identifier, '-')){
				$identifier = str_replace(' ', '-', $identifier);
			}
		}
		$this->identifier = $identifier;
	}
}