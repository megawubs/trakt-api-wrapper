<?php namespace Wubs\Trakt\Account;

use Wubs\Trakt\HttpBot;

class Account extends HttpBot{

	public function __construct(){
	}

	/**
	 * Only for devs
	 * @return bool indicator if creating account has succeded
	 */
	public function create(){
		$this->type = 'post';
		return $this->run('account/create');
	}

	public function settings(){
		$this->type = 'post';
		return $this->run('account/settings');
	}

	public function test(){
		$this->type = 'post';
		return $this->run('account/test');
	}
}