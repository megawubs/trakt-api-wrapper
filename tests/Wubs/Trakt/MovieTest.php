<?php namespace Wubs\Trakt;

class MovieTest extends \PHPUnit_Framework_TestCase{

	public function setUp(){
		$this->params = Trakt::getParams(array('username', 'password'));
	}

	public function tearDown(){}

	public function testMovieSeen(){
		$json = '{
					"username": "'.Trakt::setting('username').'",
					"password": "'.Trakt::setting('password').'",
					"movies": [
						{
							"imdb_id": "tt0114746",
							"title": "Twelve Monkeys",
							"year": 1995,
							"plays": 1,
							"last_played": 1255960578
						}
					]
				}';
		$res = Trakt::post('movie/seen')->setParams($json)->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success', $res['status']);
	}

	// public function testCheckin(){
		
	// }


}
?>