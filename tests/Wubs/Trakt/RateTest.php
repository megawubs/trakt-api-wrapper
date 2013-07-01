<?php namespace Wubs\Trakt;

class RateTest extends \PHPUnit_Framework_Testcase{

	public function setUp(){
		$this->params = array('username'=>Trakt::setting('username'), 'password'=>Trakt::setting('password'));
	}

	public function testRateEpisode(){
		// $this->markTestIncomplete();
		$res = Trakt::get('search/episodes')->setQuery('A Test of Time', true)->run();
		$episode = $res[1]['episode'];
		$show = $res[1]['show'];
		$this->params = array_merge($this->params, $episode, $show);
		$this->params['rating'] = 'love';
		$res = Trakt::post('rate/episode')->setParams($this->params)->run();
		$this->assertEquals('success', $res['status']);
		$this->assertEquals('episode', $res['type']);
	}

	public function testRateEpisodes(){
		$episodes = Trakt::get('search/episodes')->setQuery('A Test of Time', true)->run();
		$count = count($episodes);
		foreach ($episodes as $airing) {
			$episode = $airing['episode'];
			$show = $airing['show'];
			$show['rating'] = rand(1,9);
			$this->params['episodes'][] = array_merge($episode, $show);
		}
		$res = Trakt::post('rate/episodes')->setParams($this->params)->run();
		$this->assertEquals("rated $count episodes", $res['message']);
	}

	public function testRateMovie(){
		$result = Trakt::get('search/movies')->setQuery('The Matrix', true)->run();
		$movie = $result[0];
		$this->params = array_merge($this->params, $movie);
		$this->params['rating'] = rand(1,9);
		$res = Trakt::post('rate/movie')->setParams($this->params)->run();
		$this->assertContains('The Matrix', $res['message']);
		$this->assertEquals('movie', $res['type']);
	}

	public function testRateMovies(){
		$movies = Trakt::get('search/movies')->setQuery('The Matrix', true)->run();
		$count = count($movies);
		foreach ($movies as $movie) {
			$movie['rating'] = rand(1,9);
			$this->params['movies'][] = $movie;
		}
		$res = Trakt::post('rate/movies')->setParams($this->params)->run();
		$this->assertEquals("rated $count movies", $res['message']);
	}

	public function testRateShow(){
		$this->markTestIncomplete();
		$res = Trakt::post('rate/show')->setParams($this->params);
	}

	public function testRateShows(){
		$this->markTestIncomplete();
		$res = Trakt::post('rate/shows')->setParams($this->params);
	}
}

?>