<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;

class TraktTestCase extends PHPUnit_Framework_TestCase{

	public $s;

	public $user;

	public $params;

	public $key;

	public function setUp(){
		parent::setUp();
		$this->s = new Settings();
		Trakt::setApiKey($this->s->get('trakt.api'));
		$password = sha1($this->s->get('trakt.password'));
		$this->user = Trakt::user($this->s->get('trakt.username'), $password);
//        print_r($this->user);
		$this->params = array("username"=>"henk123", "password"=>$this->user->getPassword());
		$this->key = $this->s->get('trakt.api');

	}

	public function tearDown(){
		unset($this->s, $this->params, $this->key);
		parent::tearDown();
	}
}