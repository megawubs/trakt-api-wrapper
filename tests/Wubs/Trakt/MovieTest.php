<?php namespace Wubs\Trakt;

class MovieTest extends \PHPUnit_Framework_TestCase{

	public function setUp(){
		$this->params = Trakt::getParams(array('username', 'password'));
		$this->json = '{
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
	}

	public function tearDown(){}

	public function testMovieSeen(){
		$res = Trakt::post('movie/seen')->setParams($this->json)->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success', $res['status']);
	}

	public function testCheckin(){
		$result = Trakt::get('search/movies')->setQuery('the matrix', true)->run();
		$movie = $result[0];
		$params = array(
			'username'=>Trakt::setting('username')
			,'password'=>Trakt::setting('password')
			,'imdb_id'=>$movie['imdb_id']
			,'title'=>$movie['title']
			,'year'=>$movie['year']
			,'app_version' => '0.1'
			,'app_date' => 'Jun 24 2013');
		$res = Trakt::post('movie/checkin')->setParams($params)->run();
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success', $res['status']);
	}

	public function testCancelCeckin(){
		$res = Trakt::post('movie/cancelcheckin')->setParams($this->params)->run();
		$this->assertEquals('success', $res['status'] );
	}

	public function testMovieComments(){
		$res = Trakt::get('movie/comments')->setTitle('bronson-2008')->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('id', $res[0]);
	}

	public function testMovieWatching(){
		$result = Trakt::get('search/movies')->setQuery('the matrix', true)->run();
		$movie = $result[0];
		// print_r($movie);
		$params = array(
			'username'=>Trakt::setting('username')
			,'password'=>Trakt::setting('password')
			,'imdb_id'=>$movie['imdb_id']
			,'duration' =>$movie['runtime']
			,'progress'=>25
			,'title'=>$movie['title']
			,'year'=>$movie['year']
			,'app_version' => '0.1'
			,'app_date' => 'Jun 24 2013');
		$res = Trakt::post('movie/watching')->setParams($params)->run();
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success', $res['status']);
	}

	public function testMovieCancleWatching(){
		$res = Trakt::post('movie/cancelwatching')->setParams($this->params)->run();
		$this->assertEquals('success', $res['status'] );
	}

	public function testMovieWatchingScrobbleSequence(){
		$result = Trakt::get('search/movies')->setQuery('the matrix', true)->run();
		$movie = $result[0];
		$params = array(
			'username'=>Trakt::setting('username')
			,'password'=>Trakt::setting('password')
			,'imdb_id'=>$movie['imdb_id']
			,'duration' =>$movie['runtime']
			,'progress'=>25
			,'title'=>$movie['title']
			,'year'=>$movie['year']
			,'app_version' => '0.1'
			,'app_date' => 'Jun 24 2013');
		$res = Trakt::post('movie/watching')->setParams($params)->run();
		$params['progress'] = 100;
		$res = Trakt::post('movie/scrobble')->setParams($params)->run();
		$this->assertEquals('success', $res['status']);
	}

	public function testMovieLibrary(){
		$res = Trakt::post('movie/library')->setParams($this->json)->run();
		$this->assertEquals('success', $res['status']);
	}

	public function testMovieRelated(){
		$res = Trakt::get('movie/related')->setTitle('tt0111161', true)->setHideWatched('false');
		$uri = $res->getUriArray();
		$this->assertArrayHasKey('hidewatched', $uri);
		$this->assertEquals('false', $uri['hidewatched']);
		$res = $res->run();
		foreach ($res as $related) {
			$this->assertArrayHasKey('title', $related);
		}
	}

	public function testMovieSummary(){
		$summary = Trakt::get('movie/summary')->setTitle('the-social-network-2010')->run();
		$this->assertArrayHasKey('title', $summary);
		$this->assertEquals('The Social Network', $summary['title']);
	}

	public function testMovieUnlibrary(){
		$res = Trakt::post('movie/unlibrary')->setParams($this->json)->run();
		$this->assertEquals('success', $res['status']);
	}

	public function testMovieUnseen(){
		$res = Trakt::post('movie/unseen')->setParams($this->json)->run();
		$this->assertEquals('success', $res['status']);
	}

	public function testMovieWatchlist(){
		$res = Trakt::post('movie/watchlist')->setParams($this->json)->run();
		$this->assertEquals('success', $res['status']);
	}

	public function testMovieUnwatchlist(){
		$res = Trakt::post('movie/unwatchlist')->setParams($this->json)->run();
		$this->assertEquals('success', $res['status']);
	}

	public function testMovieWatchingNow(){
		$res = Trakt::get('movie/watchingnow')->setTitle('man-of-steel-2013')->run();
		$this->assertInternalType('array', $res);
		foreach ($res as $watcher) {
			$this->assertArrayHasKey('username', $watcher);
		}
	}

	public function testMoviesTrending(){
		$res = Trakt::get('movies/trending')->run();
		$this->assertInternalType('array', $res);
		foreach ($res as $movie) {
			$this->assertArrayHasKey('title', $movie);
		}
	}

	public function testMoviesUpdated(){
		$today = strtotime(date('Ymd'));
		$res = Trakt::get('movies/updated')->setTimeStamp($today)
	}
}
?>