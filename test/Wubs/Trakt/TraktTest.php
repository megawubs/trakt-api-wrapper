<?php namespace Wubs\Trakt;

class TraktTest extends \PHPUnit_Framework_TestCase{
	public function testGetAccount(){
		$this->assertInstanceOf('Wubs\Trakt\Account\Account', Trakt::get('account/settings'));
	}
}