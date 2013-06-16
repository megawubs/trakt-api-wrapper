<?php namespace Wubs\Trakt\Activity;

use Wubs\Settings\Settings;

class CommunityTest extends \PHPUnit_Framework_TestCase
{
	public function setUp(){
		$activity        = new Activity();
		$this->community = $activity->community();
		$this->s         = new Settings();
	}

	public function tearDown(){
		unset($this->community);
		unset($this->s);
	}

	public function testGetCommunityWithParamsInRequestString(){
		$uri     = 'activity/community.json';
		$types   = array('episode', 'show', 'list');
		$this->community->setTypes($types);
		$key     = $this->s->get('trakt.api');
		$uri     .= "/$key/episode,show,list";
		$this->assertEquals($uri, $this->community->getUri());
		$actions = array('watching', 'scrobble', 'seen');
		$this->community->setActions($actions);
		$uri     .= '/watching,scrobble,seen';
		$this->assertEquals($uri, $this->community->getUri());
		$this->community->setStartDate('20130512');
		$uri     .= '/'.strtotime('20130512');
		$this->assertEquals($uri, $this->community->getUri());
		$this->community->setEndDate('20130614');
		$uri     .= '/'.strtotime('20130614');
		$this->assertEquals($uri, $this->community->getUri());
		$res     = $this->community->run();
		$sRes    = json_encode($res);
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('activity', $res, "Failed to find 'activity' in: $sRes");
	}

}


?>