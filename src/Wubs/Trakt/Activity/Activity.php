<?php namespace Wubs\Trakt\Activity;

use Wubs\Trakt\HttpBot;

class Activity extends HttpBot{
	
	private $actionsSet   = false;
	
	private $startDateSet = false;
	
	private $endDateSet   = false;
	
	protected $needsType  = false;

	public function community(){
		return new Community();
	}

	public function episodes(){
		return new Episodes();
	}

	public function setActions(array$actions){
		$allowed = array('watching','scrobble','checkin','seen','collection','rating','watchlist','shout','review','created','item_added');
		$actionsString = '/'.$this->filterToCSV($actions, $allowed);
		if($this->needsType){
			if(!$this->typesSet){
				throw new \Exception("Can't set actions if types are not set");
			}
		}
		$this->appendUri($actionsString);
		return $this;
	}

	public function setStartDate($date){
		date_default_timezone_set('UTC');
		$date = strtotime($date);
		$this->appendUri('/'.$date);
		$this->startDateSet = true;
		return $this;
	}

	public function setEndDate($date){
		if($this->startDateSet){
			$date = strtotime($date);
			$this->appendUri('/'.$date);
			return $this;
		}
		else{
			throw new \Exception("Can't set end date if start date isn't set.");
		}
	}

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