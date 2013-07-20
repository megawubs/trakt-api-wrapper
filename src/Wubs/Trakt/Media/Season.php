<?php namespace Wubs\Trakt\Media;

use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Trakt;

class Season extends Media{
	public function __construct($identifier, array$info){
		parent::__construct($identifier);
		$this->dataKey = 'season/summary';
		$this->setData($this->dataKey, $info);
	}

	public function episodes($map = true){
		$episodes = Trakt::get('show/season')->setTitle($this->identifier)->setSeason($this->season)->run();
		return $episodes;
	}
}