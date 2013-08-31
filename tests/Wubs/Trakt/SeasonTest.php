<?php
use Wubs\Trakt\Trakt;

class SeasonTest extends TraktTestCase{

	public function testGetSeason(){
		$season = $this->show->season(2);
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