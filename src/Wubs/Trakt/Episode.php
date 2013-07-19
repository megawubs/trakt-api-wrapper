<?php namespace Wubs\Trakt;

use Wubs\Trakt\Base\Media;
class Episode extends Media{
	public $show;

	public function __construct($identifier, Show $show = null){
		if(is_null($show)){
			$this->show = new Show();
		}
		else{
			$this->show = $show;
		}
	}
}