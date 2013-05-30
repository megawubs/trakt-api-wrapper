<?php namespace Wubs\Trakt\Account;

use Wubs\Settings\Settings;

class AccountTest extends \PHPUnit_Framework_TestCase{
	
	protected static $file;

	protected static $content;

	public static function setUpBeforeClass(){
		self::$file = dirname(__FILE__).'/../../../../settings/settings.json';
		self::$content = file_get_contents(self::$file);
	}

	public static function tearDownAfterClass(){
		$s = new Settings();
		$s->reset(self::$content);
	}

	public function setUp(){
		$this->s = new Settings();
		$this->account = new Account();
	}

	public function tearDown(){
		unset($this->s);
		unset($this->account);
	}

	public function testGetAccountInformation(){
		$username = $this->s->get('trakt.user');
		$this->assertEquals('megawubs', $username);
		$pass = $this->s->get('trakt.pass');
		$params = '{"username":"'.$username.'","password":"'.$pass.'"}';
		$account = $this->account->setParams($params);
		$this->assertInstanceOf('Wubs\\Trakt\\Account\\Account', $account);
		$res = $this->account->settings();
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success', $res['status']);
	}
}