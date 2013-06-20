<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;
class TraktTest extends \PHPUnit_Framework_TestCase{
	public function setUp(){
		$this->params = Trakt::getParams(array('username', 'password'));
	}
	/**
	 * @expectedException Wubs\Trakt\Exceptions\TraktException
	 */
	public function testRequestNotExsistingApiRequest(){
		$res = Trakt::get('foo/bar')->run();
	}

	public function testPostAccount(){
		$this->assertArrayHasKey('status', Trakt::post('account/settings')->setParams($this->params)->run());
	}

	public function testPostSomething(){
		$this->assertInstanceOf('Wubs\Trakt\HttpBot', Trakt::post('account/test')->setParams($this->params));
	}
 
	public function testGetParams(){
		$this->assertInternalType('string', $this->params);
	}

	public function testPostTestRequest(){
		$res    = Trakt::post('account/test')->setParams($this->params)->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success',$res['status']);
	}

	public function testActivityCommunity(){
		$res = Trakt::get('activity/community')->run();
		$this->assertInternalType('array', $res);
	}

	public function testActivityCommunityWithChaining(){
		$types   = 'episode, show, list';
		$actions = 'watching, scrobble, seen';
		$res     = Trakt::get('activity/community')
		->setTypes($types)->setActions($actions)
		->setStart_ts('20130610')->setEnd_ts('20130614')
		->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res);
		$this->assertArrayHasKey('timestamps', $res);
		$this->assertEquals(strtotime('20130610'), $res['timestamps']['start']);
		$this->assertEquals(strtotime('20130614'), $res['timestamps']['end']);
		$count = count($res['activity']);
		$this->assertGreaterThan(0, $count);
	}

	public function testActivityEpisodes(){
		$res = Trakt::get('activity/episodes')->setTitles('game-of-thrones')->setSeasons('1, 2, 3')->setEpisodes('1 , 2, 3')->run();
		$this->assertInternalType('array', $res);
	}

	public function testActivityFriends(){
		$res = Trakt::post('activity/friends')->setParams($this->params)->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res);
	}

	/**
	 * @expectedException Wubs\Trakt\Exceptions\TraktException
	 */
	public function testPostWithoudParameters(){
		Trakt::post('account/test')->run();
	}

	public function testActivityMoviesWithOneTitle(){
		$res = Trakt::get('activity/movies')->setTitle('toy-story-3-2010')->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res);
	}

	public function testActivityMoviesWithMultipleTitles(){
		$res = Trakt::get('activity/movies')->setTitles('toy-story-3-2010, zero-dark-thirty-2012')->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res);
	}

	public function testActivityShows(){
		$res = Trakt::get('activity/shows')->setTitle('fringe')->run();
		$this->assertInternalType('array', $res);
	}

	public function testActivityUser(){
		$res = Trakt::get('activity/user')->setUsername('megawubs')->run();
		$this->assertInternalType('array', $res);
	}

	public function testGetCalenderPremieres(){
		$res = Trakt::get('calendar/premieres')->run();
		$this->assertInternalType('array', $res);
	}

	public function testPostCalenderPremiers(){
		$res = Trakt::post('calendar/premieres')->setParams($this->params)->run();
		$this->assertInternalType('array', $res);
	}

	public function testPostCalenderPremiersWithApiParams(){
		$days = Trakt::post('calendar/premieres')->setParams($this->params)
		->setDate('20130410')->setDays(14)->run();
		$this->assertInternalType('array', $days);
		$count = 10;
		foreach ($days as $day) {
			$this->assertArrayHasKey('date', $day);
			$this->assertEquals('2013-04-'.$count, $day['date']);
			$count +=1;
		}
	}

	public function testMagicSetter(){
		$uri = Trakt::post('calendar/premieres')->setParams($this->params)
		->setDate('20110421')->getUriArray();
		$this->assertArrayHasKey('date', $uri);
	}

	public function testCommentShow(){
		$user = Trakt::setting('username');
		$password = Trakt::setting('password');
		$params = array('username'=>$user, 'password'=>$password, 'tvdb_id'=>205281,'title'=>'Falling Skies', 'year' => 2011, 'comment' => 'It has grown into one of my favorite shows!');
		$res = Trakt::post('comment/show')->setParams($params)->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success', $res['status']);
		$this->assertContains('Falling Skies', $res['message']);
	}
}