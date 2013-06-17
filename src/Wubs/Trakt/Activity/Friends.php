<?php namespace Wubs\Trakt\Activity;

use Wubs\Trakt\HttpBot;

class Friends extends Activity{

	protected $uriOrder = array('types','actions','start_ts','end_ts');

	public function __construct(){
		$this->setUri('activity/friends.json');
		$this->type = 'post';
		// echo "$this->type\n";
	}
}