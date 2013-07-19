<?php
use Wubs\Trakt\Trakt;

class SeasonTest extends \PHPUnit_Framework_TestCase{
	public function testGetSeason(){
		$season = Trakt::show(153021)->season(2);
		$this->assertInternalType('object', $season);
		$this->assertInstanceOf('Wubs\\Trakt\\Season', $season);
	}

	public function testGetEpisodesFromSeason(){
		$season = Trakt::show(153021)->season(1);
		$episodes = $season->episodes();
		$this->assertInternalType('array', $episodes);
		$this->assertInstanceOf('Wubs\\Trakt\\Episode', $episodes[0]);
	}

	public function testGetSeasonList(){
		$seasons = Trakt::show(153021)->seasons();
		$this->assertInternalType('array', $season);
		$this->assertInstanceOf('Wubs\\Trakt\\Season', $seasons[0]);
	}
}

?>