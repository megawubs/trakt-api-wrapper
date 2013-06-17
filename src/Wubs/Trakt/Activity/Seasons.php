<?php namespace Wubs\Trakt\Activity;

class Movies extends Activity{

	protected $uriOrder = array('title','season','actions','start_ts','end_ts');

	protected $required = array('title', 'season');
}