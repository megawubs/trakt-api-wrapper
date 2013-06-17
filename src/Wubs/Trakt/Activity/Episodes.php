<?php namespace Wubs\Trakt\Activity;

class Episodes extends Activity{

	protected $uriOrder = array('titles', 'seasons', 'episodes', 'actions', 'start_ts', 'end_ts');

	protected $required = array('titles', 'seasons', 'episodes');

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
	public function setTitles($showName){
		$this->appendUri('titles',$showName);
		return $this;
	}

	/**
	 * Sets the season
	 * @param string $seasons comma separated season number(s)
	 */
	public function setSeasons($seasons){
		$this->appendUri('seasons',$seasons);
		return $this;
	}

	/**
	 * Sets the episodes
	 * @param string $episodes comma separated episode number(s)
	 */
	public function setEpisodes($episodes){
		$this->appendUri('episodes', $episodes);
		return $this;
	}
}