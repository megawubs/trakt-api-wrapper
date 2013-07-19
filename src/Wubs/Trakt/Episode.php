<?php namespace Wubs\Trakt;

class Episode{
	public $show;

	public function __construct($episodeData, Show $show = null){
		if(is_null($show)){
			$this->show = new Show($episodeData['tvdb_id']);
		}
		else{
			$this->show = $show;
		}
		
	}
}