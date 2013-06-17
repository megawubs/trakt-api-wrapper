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
}