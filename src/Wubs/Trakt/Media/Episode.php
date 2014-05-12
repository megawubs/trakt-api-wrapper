<?php namespace Wubs\Trakt\Media;

use Wubs\Trakt\Media\Media;

class Episode extends Media{
	public $show;

	protected $type = 'episode';

	public function __construct($identifier, Show $show = null){
		if(is_null($show)){
			$this->show = new Show($identifier);
		}
		else{
			$this->show = $show;
		}
	}
}