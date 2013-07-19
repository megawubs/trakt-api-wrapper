<?php namespace Wubs\Trakt;

class GerneTest extends \PHPUnit_Framework_TestCase{

	public function setUp(){
		$this->params = Trakt::getParams(array('username', 'password'));
	}

	public function testGenresMovies(){
		$res = Trakt::get('genres/movies')->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('name', $res[0]);
	}
}