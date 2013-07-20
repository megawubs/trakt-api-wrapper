<?php
use Wubs\Trakt\Trakt;

class SeasonTest extends \PHPUnit_Framework_TestCase{

	public function setUp(){
		$this->show = Trakt::show(153021);
	}

	public function tearDown(){
		unset($this->show);
	}

	public function testGetSeason(){
		$this->show->season(2);
		$this->assertInternalType('object', $season);
		$this->assertInstanceOf('Wubs\\Trakt\\Media\\Season', $season);
	}

	public function testGetEpisodesFromSeason(){
		$season = $this->show->season(1);
		$episodes = $season->episodes();
		$this->assertInternalType('array', $episodes);
		// $this->assertInstanceOf('Wubs\\Trakt\\Episode', $episodes[0]);
	}
}

?>