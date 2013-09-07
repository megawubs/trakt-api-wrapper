<?php namespace Wubs\Trakt\Media;

use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Trakt;

class Season extends Media{

	protected $type = 'season';

	public function __construct($identifier, array$info){
		parent::__construct($identifier);
		$this->setDataKey('summary');
		$this->setData($this->dataKey, $info);
	}

	public function episodes($map = true){
		$request = $this->get('season')->setTitle($this->identifier)->setSeason($this->season);
		$episodes = $this->runAndSave($request);
		return $episodes;
	}
}