<?php namespace Wubs\Trakt\Activity;

class Movies extends Activity{

	protected $uriOrder = array('title','actions','start_ts','end_ts');

	protected $required = array('title');

	public function __construct(){
		$this->setUri('activity/movies.json');
	}
}