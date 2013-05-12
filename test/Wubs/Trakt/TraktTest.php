<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;
class TraktTest extends \PHPUnit_Framework_TestCase{

	public function testPostAccount(){
		$s = new Settings();
		$username = $s->get('trakt.user');
		$pass = sha1($s->get('trakt.pass'));
		$params = '{"username":"'.$username.'","password":"'.$pass.'"}';
		$this->assertArrayHasKey('status', Trakt::post('account/settings', $params));
	}

	public function testPostSomething(){
		$json = '{"username": "justin","password": "sha1hash","email": "username@gmail.com"}';
		$this->assertInstanceOf('Wubs\Trakt\Account\Account', Trakt::post('account/create', $json));
	}
}