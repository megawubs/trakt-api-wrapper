<?php namespace Wubs\Trakt\Activity;

class Episodes extends Activity{

	public function __construct(){
		$this->setUri('activity/episodes.json');
	}

	public function setShow($showName){
		$this->appendUri("/$showName");
		return $this;
	}

	public function setSeasons($seasons){
		$this->appendUri("/$seasons");
		return $this;
	}

	public function setEpisodes($episodes){
		$this->appendUri("/$episodes");
		return $this;
	}
}