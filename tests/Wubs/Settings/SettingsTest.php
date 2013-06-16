<?php namespace Wubs\Settings;

class SettingsTest extends \PHPUnit_Framework_TestCase{
	protected static $file;

	protected static $content;

	public static function setUpBeforeClass(){
		self::$file    = dirname(__FILE__).'/../../../settings/settings.json';
		self::$content = file_get_contents(self::$file);
	}
	public function setUp(){
		$this->s = new Settings();
	}

	public function tearDown(){
		unset($this->s);
	}

	public function testSetUser(){
		$this->assertTrue($this->s->set('trakt.user', 'John'));
	}

	public function testSetApi(){
		$this->assertTrue($this->s->set('trakt.api', '17f2342eer3533sdfge16b25f164d3'));
	}

	public function testSetPass(){
		$this->assertTrue($this->s->set('trakt.pass', 'Doe123'));
	}

	public function testGetUser(){
		$this->assertEquals('John', $this->s->get('trakt.user'));
	}

	public function testGetApi(){
		$this->assertEquals('17f2342eer3533sdfge16b25f164d3', $this->s->get('trakt.api'));
	}

	public function testGetPass(){
		$this->assertEquals('Doe123', $this->s->get('trakt.pass'));
	}

	public function testSettingsReset(){
		$this->assertTrue($this->s->reset());
		$this->assertEquals('', $this->s->get('trakt.username'));
		$this->assertTrue($this->s->set('trakt.username', 'John'));
		$this->assertEquals('John', $this->s->get('trakt.username'));
	}

	public function testGetAllSettingsFromTrakt(){
		$this->assertInstanceOf('stdClass', $this->s->get('trakt'));
	}

	public static function tearDownAfterClass(){
		$s = new Settings();
		$s->reset(self::$content);
	}
}