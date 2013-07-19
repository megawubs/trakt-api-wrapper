<?php

use Wubs\Trakt\Trakt;

class ShowTest extends \PHPUnit_Framework_TestCase{

	public function testGetShowObject(){
		$show = Trakt::show(153021);
		$this->assertInstanceOf('Wubs\\Trakt\\Show', $show);
		$this->assertEquals('The Walking Dead', $show->title);
	}

	public function testGetShowSeasons(){
		$show = Trakt::show(153021);
		$seasons = $show->seasons();
		$this->assertInternalType('array', $seasons);
		foreach ($seasons as $season) {
			$this->assertArrayHasKey('data', $season);
		}
	}

	public function testGetOneSeason(){
		$season = Trakt::show(153021)->season(1);
		$this->assertInternalType('object', $season);
		$this->assertEquals(1, $season->season);
	}

	public function testGetAllSeasonFirstThanOneSeason(){
		$show = Trakt::show(153021);
		$seasons = $show->seasons(); //this should make an request
		$this->assertInternalType('array', $seasons);
		$this->assertEquals(4, $seasons[0]['season']);
		$season1 = $show->season(1); //this should not make a request
		$this->assertEquals(1, $season1['season']);
	}
}