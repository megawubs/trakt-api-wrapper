<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;

class TraktTestCase extends PHPUnit_Framework_TestCase{

	public function setUp(){
		parent::setUp();
		$this->s = new Settings();
		// Trakt::setApiKey($this->s->get('trakt.api'));
		// $password = sha1($this->s->get('trakt.password'));
		// $this->user = Trakt::user($this->s->get('trakt.username'), $password);
		// $this->params = array("username"=>$this->user->username, "password"=>$this->user->getPassword());
		$this->key = $this->s->get('trakt.api');
	}

	public function tearDown(){
		unset($this->s, $this->params, $this->key);
		parent::tearDown();
	}
}