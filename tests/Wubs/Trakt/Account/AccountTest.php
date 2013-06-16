<?php namespace Wubs\Trakt\Account;

use Wubs\Settings\Settings;
use Wubs\Trakt\Trakt;

class AccountTest extends \PHPUnit_Framework_TestCase{
	
	protected static $file;

	protected static $content;

	public static function setUpBeforeClass(){
		self::$file    = dirname(__FILE__).'/../../../../settings/settings.json';
		self::$content = file_get_contents(self::$file);
	}

	public static function tearDownAfterClass(){
		$s = new Settings();
		$s->reset(self::$content);
	}

	public function setUp(){
		$this->s       = new Settings();
		$this->account = new Account();
	}

	public function tearDown(){
		unset($this->s);
		unset($this->account);
	}

	public function testGetAccountInformation(){
		$username = $this->s->get('trakt.username');
		$this->assertEquals('megawubs', $username);
		$pass     = $this->s->get('trakt.password');
		$params   = '{"username":"'.$username.'","password":"'.$pass.'"}';
		$account  = $this->account->setParams($params);
		$this->assertInstanceOf('Wubs\\Trakt\\Account\\Account', $account);
		$res      = $this->account->settings();
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success', $res['status']);
	}

	public function testTestAccount(){
		$params  = Trakt::getParams(array('username', 'password'));
		$account = $this->account->setParams($params);
		$res     = $this->account->test();
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success', $res['status']);
	}

	public function testCreateAccount(){
		$this->markTestSkipped("I don't have a dev api key yet");
		$params  = '{"username": "justin", "password": "sha1hash","email": "username@gmail.com"}';
		$account = $this->account->setParams($params);
		$res     = $this->account->create();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('status', $res);
	}
}