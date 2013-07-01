<?php namespace Wubs\Trakt;


class NetworkTest extends \PHPUnit_Framework_TestCase{

	public function setUp(){
		$this->params = array('username'=>Trakt::setting('username'), 'password'=>Trakt::setting('password'));
	}

	public function testNetworkFollow(){
		// $this->markTestIncomplete();
		$this->params['user'] = 'megawubs';
		$res = Trakt::post('network/follow')->setParams($this->params)->run();
		$this->assertEquals('success', $res['status']);
	}

	public function testNetworkRequests(){
		// $this->markTestIncomplete();
		$res = Trakt::post('network/requests')->setParams($this->params)->run();
		if(!$this->identicalTo(array(), $res)){
			$this->assertEquals('megawubs', $res[0]['username']);
		}
		else{
			$this->markTestSkipped();
		}
	}

	public function testNetworkDeny(){
		// $this->markTestIncomplete();
		$this->params['user'] = 'megawubs';
		$res = Trakt::post('network/deny')->setParams($this->params)->run();
		$this->assertEquals('denied megawubs', $res['message']);
	}

	public function testNetworkApprove(){
		$this->params['user'] = 'megawubs';
		$res = Trakt::post('network/approve')->setParams($this->params)->run();
		$this->assertEquals('approved megawubs', $res['message']);
	}

	public function testNetworkUnfollow(){
		$this->params['user'] = 'megawubs';
		$res = Trakt::post('network/unfollow')->setParams($this->params)->run();
		$this->assertEquals('unfollowed megawubs', $res['message']);
	}
}