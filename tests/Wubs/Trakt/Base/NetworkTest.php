<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;

class NetworkTest extends TraktTestCase{

	public function testNetworkFollow(){
		$this->params['user'] = 'megawubs';
		$res = Trakt::post('network/follow')->setParams($this->params)->run();
		$this->assertEquals('success', $res['status']);
	}

	public function testNetworkRequests(){
		$res = Trakt::post('network/requests')->setParams($this->params)->run();
		if(!$this->identicalTo(array(), $res)){
			$this->assertEquals('megawubs', $res[0]['username']);
		}
		else{
			$this->markTestSkipped();
		}
	}

	public function testNetworkDeny(){
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