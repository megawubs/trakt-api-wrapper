<?php namespace Wubs\Trakt\Activity;


class Community extends Activity{

	protected $uriOrder = array('types', 'actions', 'start_ts', 'end_ts');
	
	protected $required = array();

	/**
	 * Sets the uri
	 */
	public function __construct(){
		$this->setUri('activity/community.json');
	}

	/**
	 * Sets the types part of the uri
	 * @param array $types list of types
	 */
	public function setTypes(array$types){
		$allowed        = array('episode','show','movie','list');
		$typesString    = $this->filterToCSV($types, $allowed);
		$this->appendUri('types', $typesString);
		return $this;
	}
}