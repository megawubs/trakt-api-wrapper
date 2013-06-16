<?php namespace Wubs\Trakt\Activity;


class Community extends Activity{

	protected $typesSet = false;

	public function __construct(){
		$this->setUri('activity/community.json');
		$this->needsType = true;
	}

	public function setTypes(array$types){
		$allowed = array('episode','show','movie','list');
		$typesString = '/'.$this->filterToCSV($types, $allowed);
		$this->appendUri($typesString);
		$this->typesSet = true;
		return $this;
	}
}