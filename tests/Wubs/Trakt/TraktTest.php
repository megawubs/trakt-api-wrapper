<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;
class TraktTest extends \PHPUnit_Framework_TestCase{

	public function testPostAccount(){
		$s = new Settings();
		$username = $s->get('trakt.username');
		$pass = sha1($s->get('trakt.password'));
		$params = '{"username":"'.$username.'","password":"'.$pass.'"}';
		$this->assertArrayHasKey('status', Trakt::post('account/settings', $params));
	}

	public function testPostSomething(){
		$json = '{"username": "justin","password": "sha1hash","email": "username@gmail.com"}';
		$this->assertInstanceOf('Wubs\Trakt\Account\Account', Trakt::post('account/create', $json));
	}
 
	public function testGetParams(){
		$params = Trakt::getParams(array('username', 'password'));
		$this->assertInternalType('string', $params);
	}

	public function testPostTestRequest(){
		$params = Trakt::getParams(array('username', 'password'));
		$res = Trakt::post('account/test', $params);
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success',$res['status']);
	}

}