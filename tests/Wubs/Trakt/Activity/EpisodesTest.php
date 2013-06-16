<?php namespace Wubs\Trakt\Activity;

use Wubs\Settings\Settings;

class EpisodesTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{	
		$activity       = new Activity();
		$this->s        = new Settings();
		$this->episodes = $activity->episodes();
	}

	public function tearDown()
	{
		unset($this->s);
		unset($this->episodes);
	}

	public function testEpisodeObject(){
		$this->assertInstanceOf('Wubs\Trakt\Activity\Episodes', $this->episodes);
	}

	public function testGetEpisodesActivity(){
		$this->markTestSkipped('Not implementd yet!');
		$this->episodes->setShow('fringe');
		$uri = 'activity/episodes.json/'.$this->s->get('trakt.api');
		$this->assertEquals($uri.'/fringe', $this->episodes->getUri());
		$res = $this->episodes->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res);
	}
}


?>