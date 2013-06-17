<?php namespace Wubs\Trakt\Activity;

use Wubs\Settings\Settings;

class EpisodesTest extends \PHPUnit_Framework_TestCase
{
	public function setUp(){
		$activity       = new Activity();
		$this->s        = new Settings();
		$this->episodes = $activity->episodes();
	}

	public function tearDown(){
		unset($this->s);
		unset($this->episodes);
	}

	public function testEpisodeObject(){
		$this->assertInstanceOf('Wubs\Trakt\Activity\Episodes', $this->episodes);
	}

	public function testGetEpisodesActivity(){
		$this->episodes->setTitles('fringe');
		$uri = 'activity/episodes.json/'.$this->s->get('trakt.api').'/fringe';
		$this->episodes->setSeasons('3')->setEpisodes('3,4,5');
		$uri .= '/3/3,4,5';
		$res = $this->episodes->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res);
	}

	public function testSettingParametersInWrongOrder(){
		// $this->markTestSkipped('Not implementd yet!');
		$request = $this->episodes->setEpisodes('1,3,4')->setTitles('fringe');
		$this->assertInstanceOf('Wubs\Trakt\Activity\Episodes', $request);
	}

	/**
	 * @expectedException Wubs\Trakt\Exceptions\TraktException
	 */
	public function testRequestWithoutRequiredUriParts(){
		$this->episodes->setEpisodes('1,3,4')->setTitles('fringe')->run();
	}
}


?>