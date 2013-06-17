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
		return $this->setUri('account/create');
	}

	/**
	 * Retrieves the settings from the user given in the params
	 * @return array the settings of the user mapped to an array
	 */
	public function settings(){
		$this->type = 'post';
		return $this->setUri('account/settings');
	}

	/**
	 * Test if the given user can access Trakt.tv
	 * @return array the response form Trakt.tv mapped to an array
	 */
	public function test(){
		$this->type = 'post';
		return $this->setUri('account/test');
	}
}