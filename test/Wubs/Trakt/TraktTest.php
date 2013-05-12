<?php namespace Wubs\Trakt;

class TraktTest extends \PHPUnit_Framework_TestCase{

	public function testGetAccount(){
		$this->assertInstanceOf('Wubs\Trakt\Account\Account', Trakt::get('account/settings'));
	}

	public function testPostSomething(){
		$json = '{"username": "justin","password": "sha1hash","email": "username@gmail.com"}';
		$this->assertInstanceOf('Wubs\Trakt\Account\Account', Trakt::post('account/create', $json));
	}
}