<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;

class UserTest extends TraktTestCase{
	public static function setUpBeforeClass(){
		date_default_timezone_set('UTC');
	}

	public function testSetUser(){
		$user = Trakt::user('megawubs');
		$this->assertInstanceOf('Wubs\\Trakt\\User', $user);
	}

	public function testUserGetShowsInCalendarWithDateAsEpisodeInstance(){
		$user = Trakt::user('megawubs');
		$calendar = $user->getCalendar('2013-07-18');
		// foreach ($calendar[0]['episodes'] as $episode) {
		// 	$this->assertInstanceOf('Wubs\\Trakt\\Episode', $episode);
		// }
	}

	/**
	 * @expectedException Wubs\Trakt\Exceptions\TraktException
	 */
	public function testUserGetShowInCalendarWithWrongDateFormat(){
		$user = Trakt::user('megawubs');
		$calendar = $user->getCalendar('12-08-2012');
	}
}