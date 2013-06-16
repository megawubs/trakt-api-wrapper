<?php namespace Wubs\Trakt\Activity;

class Episodes extends Activity{

	/**
	 * Sets the uri
	 */
	public function __construct(){
		$this->setUri('activity/episodes.json');
	}

	/**
	 * Sets the show
	 * @param string $showName comma separated show name(s)
	 */
	public function setShow($showName){
		$this->appendUri("/$showName");
		return $this;
	}

	/**
	 * Sets the season
	 * @param string $seasons comma separated season number(s)
	 */
	public function setSeasons($seasons){
		$this->appendUri("/$seasons");
		return $this;
	}

	/**
	 * Sets the episodes
	 * @param string $episodes comma separated episode number(s)
	 */
	public function setEpisodes($episodes){
		$this->appendUri("/$episodes");
		return $this;
	}
}