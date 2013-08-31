<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;

class TraktTestCase extends PHPUnit_Framework_TestCase{

	public function setUp(){
		parent::setUp();
		$this->s = new Settings();
		Trakt::setApiKey($this->s->get('trakt.api'));
		$this->params = array("username"=>$this->s->get('trakt.username'), "password"=>$this->s->get('trakt.password'));
		$this->show = Trakt::show(153021);
		$this->key = $this->s->get('trakt.api');
	}

	public function tearDown(){
		unset($this->s, $this->params, $this->show, $this->key);
	}
}