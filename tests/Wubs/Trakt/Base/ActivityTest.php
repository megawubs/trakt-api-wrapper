<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;

class ActivityTest extends TraktTestCase{

	public function testActivityCommunity(){
		$res = Trakt::get('activity/community')->run();
		$this->assertInternalType('array', $res);
	}

	public function testActivityCommunityWithChaining(){
		date_default_timezone_set('UTC');
		$types   = 'episode, show, list';
		$actions = 'watching, scrobble, seen';
		$res     = Trakt::get('activity/community')
		->setTypes($types)->setActions($actions)
		->setStart_ts(strtotime('20130610'))->setEnd_ts(strtotime('20130614'))
		->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res);
		$this->assertArrayHasKey('timestamps', $res);
		$this->assertEquals(strtotime('20130610'), $res['timestamps']['start']);
		$this->assertEquals(strtotime('20130614'), $res['timestamps']['end']);
		$count = count($res['activity']);
		$this->assertGreaterThan(0, $count);
	}

	public function testActivityEpisodes(){
		$res = Trakt::get('activity/episodes')->setTitles('game-of-thrones')->setSeasons('1, 2, 3')->setEpisodes('1 , 2, 3')->run();
		$this->assertInternalType('array', $res);
	}

	public function testActivityFriends(){
		$res = Trakt::post('activity/friends')->setParams($this->params)->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res);
	}

	public function testActivityMoviesWithOneTitle(){
		$res = Trakt::get('activity/movies')->setTitle('toy-story-3-2010')->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res);
	}

	public function testActivityMoviesWithMultipleTitles(){
		$res = Trakt::get('activity/movies')->setTitles('toy-story-3-2010, zero-dark-thirty-2012')->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res);
	}

	public function testActivityShows(){
		$res = Trakt::get('activity/shows')->setTitle('fringe')->run();
		$this->assertInternalType('array', $res);
	}

	public function testActivityUser(){
		$res = Trakt::get('activity/user')->setUsername('megawubs')->run();
		$this->assertInternalType('array', $res);
	}
}