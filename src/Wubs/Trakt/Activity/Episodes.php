<?php namespace Wubs\Trakt\Activity;

class Episodes extends Activity{

	protected $uriOrder = array('title', 'season', 'episode', 'actions', 'start_ts', 'end_ts');

	protected $required = array('title', 'season', 'episode');

	/**
	 * Sets the uri
	 */
	public function __construct(){
		$this->setUri('activity/episodes.json');
	}
}