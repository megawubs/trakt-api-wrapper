<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;

class GerneTest extends TraktTestCase{

	public function testGenresMovies(){
		$res = Trakt::get('genres/movies')->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('name', $res[0]);
	}
}