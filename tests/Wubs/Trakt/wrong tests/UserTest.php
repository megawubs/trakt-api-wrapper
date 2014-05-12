<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;

class UserTest extends TraktTestCase{
	public static function setUpBeforeClass(){
		date_default_timezone_set('UTC');
	}

	public function testSetUser(){
		$user = Trakt::user($this->s->get('trakt.username'));
		$this->assertInstanceOf('Wubs\\Trakt\\User', $user);
	}

	/**
	 * @expectedException Wubs\Trakt\Exceptions\TraktException
	 */
	public function testGetPasswordWhenNoPasswordIsSet(){
		$user = Trakt::user($this->s->get('trakt.username'));
		$user->getPassword();
	}

	public function testUserGetShowsInCalendarWithDateAsEpisodeInstance(){
		$user = Trakt::user($this->s->get('trakt.username'));
		$calendar = $user->getCalendar('2013-07-18');
		// foreach ($calendar[0]['episodes'] as $episode) {
		// 	$this->assertInstanceOf('Wubs\\Trakt\\Episode', $episode);
		// }
	}

	/**
	 * @expectedException Wubs\Trakt\Exceptions\TraktException
	 */
	public function testUserGetShowInCalendarWithWrongDateFormat(){
		$user = Trakt::user($this->s->get('trakt.username'));
		$calendar = $user->getCalendar('12-08-2012');
	}

	public function testUserWithPassword(){
		$username = $this->user->username;
		$password = $this->user->getPassword();
		$this->assertNotNull($password);
		$user = Trakt::user($username, $password);
		$this->assertEquals($password, $user->getPassword());
		$this->assertEquals($username, $user->username);
	}
}