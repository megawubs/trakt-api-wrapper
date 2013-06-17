<?php namespace Wubs\Trakt\Activity;

use Wubs\Settings\Settings;

class MoviesTest extends \PHPUnit_Framework_TestCase{
	public function setUp(){
		$activity       = new Activity();
		$this->s        = new Settings();
		$this->movies = $activity->movies();
	}

	public function tearDown(){
		unset($this->s);
		unset($this->movies);
	}

	public function testGetActivityMovies(){
		$res = $this->movies->setTitles('toy-story-3-2010')->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res);
	}
}

?>