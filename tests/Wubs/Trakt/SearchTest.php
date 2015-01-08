<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;

class SearchTest extends TraktTestCase{

	public function testSearchMovie(){
		$res = Trakt::get('search/movies')->setQuery('lucky number slevin', true)->run();
		$this->assertArrayHasKey('title', $res[0]);
		$this->assertEquals('Lucky Number Slevin', $res[0]['title']);
	}

	public function testSearchEpisodes(){
		$res = Trakt::get('search/episodes')->setQuery('A Test of Time', true)->run();
		foreach ($res as $result) {
			$this->assertArrayHasKey('show', $result);
			$this->assertArrayHasKey('episode', $result);
		}
	}

	public function testSearchPeople(){
		$res = Trakt::get('search/people')->setQuery('Jim', true)->run();
		$this->assertArrayHasKey('name', $res[0]);
		$this->assertContains('Jim', $res[0]['name']);
	}
}