<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;

class CommentTest extends TraktTestCase{

	public function testCommentShow(){
		$this->markTestSkipped('Tested once, works!');
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