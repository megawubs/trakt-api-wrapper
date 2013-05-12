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
		return $this;
	}

	public function settings(){
		$this->type = 'post';
		$this->setUri('account/settings');
		$this->execute();
		return $this->response;
	}
}