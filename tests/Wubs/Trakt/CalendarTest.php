<?php namespace Wubs\Trakt;

class CalendarTest extends \PHPUnit_Framework_TestCase{
	
	public function setUp(){
		$this->params = Trakt::getParams(array('username', 'password'));
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

}