<?php namespace Wubs\Trakt\Activity;

use Wubs\Settings\Settings;
use Wubs\Trakt\Trakt;


class ActivityTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->s        = new Settings();
		$this->activity = new Activity();
	}

	public function tearDown()
	{
		unset($this->s);
		unset($this->activity);
	}

	public function testGetCommunity(){
		$community = $this->activity->community();
		$this->assertInternalType('object', $community);
		$this->assertInstanceOf('Wubs\Trakt\Activity\Activity', $community);
		$res       = $community->run();
		$this->assertInternalType('array', $res);
	}

	/**
     * @expectedException Wubs\Trakt\Exceptions\TraktException
     */
	public function testSettingActivityBeforeSettingTypes(){
		$actions   = array('watching');
		$request = $this->activity->community()->setActions($actions)->run();
	}

	/**
     * @expectedException Wubs\Trakt\Exceptions\TraktException
     */
	public function testSettingEndDateBeforeSettingStartDate(){
		$endate = '20130616';
		$this->activity->community()->setEndDate($endate)->run();
	}
}


?>