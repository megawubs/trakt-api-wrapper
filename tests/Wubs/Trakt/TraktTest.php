<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;
class TraktTest extends \PHPUnit_Framework_TestCase{

	public function testPostAccount(){
		$s        = new Settings();
		$username = $s->get('trakt.username');
		$pass     = sha1($s->get('trakt.password'));
		$params   = '{"username":"'.$username.'","password":"'.$pass.'"}';
		$this->assertArrayHasKey('status', Trakt::post('account/settings')->setParams($params)->run());
	}

	public function testPostSomething(){
		$json = Trakt::getParams(array('username', 'password'));
		$this->assertInstanceOf('Wubs\Trakt\Account\Account', Trakt::post('account/test')->setParams($json));
	}
 
	public function testGetParams(){
		$params = Trakt::getParams(array('username', 'password'));
		$this->assertInternalType('string', $params);
	}

	public function testPostTestRequest(){
		$params = Trakt::getParams(array('username', 'password'));
		$res    = Trakt::post('account/test')->setParams($params)->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success',$res['status']);
	}

	public function testActivityCommunity(){
		$res = Trakt::get('activity/community')->run();
		$this->assertInternalType('array', $res);
	}

	public function testActivityCommunityWithChaining(){
		$types   = array('episode', 'show', 'list');
		$actions = array('watching', 'scrobble', 'seen');
		$res     = Trakt::get('activity/community')->setTypes($types)->setActions($actions)->setStartDate('20130512')->setEndDate('20130614')->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res);
	}

	public function testActivityEpisodes(){
		$res = Trakt::get('activity/episodes')->setTitles('game-of-thrones')->setSeasons('1,2,3')->setEpisodes('1,2,3')->run();
		$this->assertInternalType('array', $res);
	}

	public function testActivityFriends(){
		$params = Trakt::getParams(array('username', 'password'));
		$res = Trakt::post('activity/friends')->setParams($params)->run();
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

}