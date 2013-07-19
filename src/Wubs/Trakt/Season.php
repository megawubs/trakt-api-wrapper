<?php namespace Wubs\Trakt;

use Wubs\Trakt\Base\Media;

class Season extends Media{
	public function __construct($identifier, array$info){
		parent::__construct($identifier);
		$this->dataKey = 'season/summary';
		$this->setData($this->dataKey, $info);
	}

	public function episodes(){
		$this->data['season/episodes'] = Trakt::get('show/season')->setTitle($this->identifier)->run();
	}
}