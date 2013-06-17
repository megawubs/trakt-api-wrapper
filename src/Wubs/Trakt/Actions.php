<?php namespace Wubs\Trakt;

class Actions{

	/**
	 * Sets the actions part of the uri
	 * @param array $actions list of actions to set
	 * @return  Wubs\Trakt\Activity\[mixed]
	 */
	public function setActions(array$actions){
		$allowed       = array('watching','scrobble','checkin','seen','collection','rating','watchlist','shout','review','created','item_added');
		$actionsString = $this->filterToCSV($actions, $allowed);
		return $this->appendUri('actions', $actionsString);
	}

	/**
	 * Sets the startdate part of the rui
	 * @param string $date Ymd (20130616) time string
	 * @return Wubs\Trakt\Activity\[mixed]
	 */
	public function setStartDate($date){
		date_default_timezone_set('UTC');
		$date = strtotime($date);
		return $this->appendUri('start_ts',$date);
		
	}

	/**
	 * Sets the endate part of the uri
	 * @param string $date Ymd (20130616) time string
	 */
	public function setEndDate($date){
		date_default_timezone_set('UTC');
		$date = strtotime($date);
		return $this->appendUri('end_ts', $date);
	}

	/**
	 * Makes comma separated list from array, with only
	 * the allowed items in $allowed
	 * @param  array $array   the array to map to commas
	 * @param  array $allowed the array with allowed values
	 * @return string          filtered string with comma's
	 */
	protected function filterToCSV($array, $allowed){
		$keyString = '';
		foreach ($array as $key) {
			if(in_array($key, $allowed)){
				$keyString .= $key.' ';
			}
		}
		return str_replace(' ', ',', trim($keyString));
	}

	/**
	 * Sets the titles
	 * @param string $showName comma separated show name(s)
	 */
	public function setTitles($titles){
		$this->appendUri('title',$titles);
		return $this;
	}

	/**
	 * Singular version of setTiles
	 * @param string $title the title
	 */
	public function setTitle($title){
		return $this->setTitles($title);
	}

	/**
	 * Sets the season
	 * @param string $seasons comma separated season number(s)
	 */
	public function setSeasons($seasons){
		$this->appendUri('season',$seasons);
		return $this;
	}

	/**
	 * Singular version of setSeasons
	 * @param string $season the season number
	 */
	public function setSeason($season){
		return $this->setSeasons($season);
	}

	/**
	 * Sets the episodes
	 * @param string $episodes comma separated episode number(s)
	 */
	public function setEpisodes($episodes){
		$this->appendUri('episode', $episodes);
		return $this;
	}

	/**
	 * Singular version of setEpisodes
	 * @param string $episode the episode number
	 */
	public function setEpisode($episode){
		return $this->setEpisodes($episode);
	}
}