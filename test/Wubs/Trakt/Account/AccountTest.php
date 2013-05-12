<?php namespace Wubs\Trakt\Account;

use Wubs\Settings\Settings;

class AccountTest extends \PHPUnit_Framework_TestCase{

	public function testGetAccountInformation(){
		// $this->markTestIncomplete('This test has not been implemented yet.');
		$account = new Account();
		$s = new Settings();
		$username = $s->get('trakt.user');
		$pass = sha1($s->get('trakt.pass'));
		$params = '{"username":"'.$username.'","password":"'.$pass.'"}';
		$account->setParams($params);
		$res = $account->settings();
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success', $res['status']);
	}
}