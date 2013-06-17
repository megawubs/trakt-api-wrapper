<?php namespace Wubs\Trakt\Activity;

use Wubs\Trakt\HttpBot;

class Activity extends HttpBot{
	
	private $actionsSet   = false;
	
	private $startDateSet = false;
	
	private $endDateSet   = false;
	
	protected $needsType  = false;

	/**
	 * Runs when calling Trakt::get('activity/community');
	 * @return Wubs\Trakt\Activity\Community 
	 * Object with specific methods for the Community call
	 */
	public function community(){
		return new Community();
	}

	/**
	 * Runs when calling Trakt::get('activity/episodes');
	 * @return Wubs\Trakt\Activity\Episodes 
	 * Object with specific methods for the Episodes call
	 */
	public function episodes(){
		return new Episodes();
	}

	public function friends(){
		return new Friends();
	}
	/**
	 * Sets the actions part of the uri
	 * @param array $actions list of actions to set
	 * @return  Wubs\Trakt\Activity\[mixed]
	 * @throws \Exception If Type is needed and it's not set
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
}