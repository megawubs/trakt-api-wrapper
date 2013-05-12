<?php namespace Wubs\Trakt\Account;

class Account{

	public function __construct(){
	}

	/**
	 * Only for devs
	 * @return bool indicator if creating account has succeded
	 */
	public function create(){
		return true;
	}

	public function settings(){
		return $this;
	}
}