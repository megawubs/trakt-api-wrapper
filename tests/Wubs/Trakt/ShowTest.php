<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;
class ShowTest extends TraktTestCase{

	public $show;

	public function setUp(){
		parent::setUp();
		$this->show = Trakt::show(153021); //The Walking Dead
		$this->show->setUser($this->user);
	}

	public function tearDown(){
		unset($this->user, $this->show);
	}

	public function testGetShowObject(){
		$this->assertInstanceOf('Wubs\\Trakt\\Media\\Show', $this->show);
		$this->assertEquals('The Walking Dead', $this->show->title);
	}


	public function testSetUserOnShowObject(){
		$show = Trakt::show(153021);
		$user = Trakt::user($this->s->get('trakt.username'), $this->s->get('trakt.password'));
		$show->setUser($user);
		$this->assertInstanceOf('Wubs\\Trakt\\User', $show->getUser());
		$this->assertEquals($user, $show->getUser());
	}

	public function testGetShowSeasons(){
		$seasons = $this->show->seasons(); //this should make an request and return an array of season objects
		$this->assertInternalType('array', $seasons);
		foreach ($seasons as $season) {
			$this->assertInternalType('object', $season);
			$this->assertInstanceOf('Wubs\\Trakt\\Media\\Season', $season);
		}
	}

	public function testGetSeasonList(){
		$seasons = $this->show->seasons();
		$this->assertInternalType('array', $seasons);
		$this->assertInstanceOf('Wubs\\Trakt\\Media\\Season', $seasons[0]);
	}

	public function testGetOneSeason(){
		$season = $this->show->season(1); //This should make a request and return a season object
		$this->assertInternalType('object', $season);
		$this->assertInstanceOf('Wubs\\Trakt\\Media\\Season', $season);
		$this->assertEquals(1, $season->season);
	}

	public function testGetAllSeasonsFirstAsArrayThanOneSeasonAsObject(){
		$seasons = $this->show->seasons(false); // This should make a request and return an array of season arrays
		$this->assertInternalType('array', $seasons);
		foreach ($seasons as $season) {
			$this->assertInternalType('array', $season);
			$this->assertArrayHasKey('season', $season);
		}
		$this->assertEquals(4, $seasons[0]['season']); // first element in array is last season of show
		$season1 = $this->show->season(1); //this should not make a request and return an object
		$this->assertInternalType('object', $season1);
		$this->assertInstanceOf('Wubs\\Trakt\\Media\\Season', $season1);
		$this->assertEquals(1, $season1->season);
	}

	public function testGetAllSeasonsFirstAsObjectThanOneSeasonAsArray(){
		$seasons = $this->show->seasons(); //array of objects
		$this->assertInternalType('array', $seasons);
		foreach ($seasons as $season) {
			$this->assertInternalType('object', $season);
		}
		$season = $this->show->season(1, false); //one array
		$this->assertInternalType('array', $season);
		$this->assertArrayHasKey('season', $season);
		$this->assertEquals(1, $season['season']);
	}

	public function testGetShowAllComments(){
		$comments = $this->show->comments();
		$this->assertInternalType('array', $comments);
		foreach ($comments as $comment) {
			$this->assertArrayHasKey('inserted', $comment);
		}
	}

	public function testGetShowShoutComments(){
		$comments = $this->show->comments('shouts');
		foreach ($comments as $comment) {
			$this->assertArrayHasKey('inserted', $comment);
			$this->assertEquals('shout', $comment['type']);
		}
	}

	public function testGetShowReviewComments(){
		$comments = $this->show->comments('reviews');
		foreach ($comments as $comment) {
			$this->assertArrayHasKey('inserted', $comment);
			$this->assertEquals('review', $comment['type']);
		}
	}

	public function testGetShowReviewsByReviewMethod(){
		$reviews = $this->show->reviews();
		foreach ($reviews as $review) {
			$this->assertArrayHasKey('inserted', $review);
			$this->assertEquals('review', $review['type']);
		}
	}

	public function testGetShoutsByShoutsMethod(){
		$shouts = $this->show->shouts();
		foreach ($shouts as $shout) {
			$this->assertArrayHasKey('inserted', $shout);
			$this->assertEquals('shout', $shout['type']);
		}
	}

	public function testCheckInShow(){
		$result = $this->show->checkIn(1, 1, 'Re-watching season one');
		$this->assertTrue($result);
	}

	public function testCancelCheckIn(){
		$result = $this->show->cancelCheckIn();
		$this->assertTrue($result);
	}

	public function testShowWatching(){
		$season = 1;
		$episode = 2;
		$progress = 25;
		$result = $this->show->watching($season, $episode, $progress);
		$this->assertTrue($result);
	}

	public function testCancleWatching(){
		$password = $this->user->getPassword();
		$result = $this->show->cancelWatching();
		$this->assertTrue($result);
	}
}