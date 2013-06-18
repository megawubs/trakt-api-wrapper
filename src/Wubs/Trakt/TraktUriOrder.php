<?php namespace Wubs\Trakt;

return array(
	'account/create' => array(
		'order' => array(),'required' => array())
	,'account/settings' => array(
		'order' => array(),'required' => array())
	,'account/test' => array(
		'order' => array(),'required' => array())
	,'activity/community' => array(
		'order' => array('types','actions','start_ts','end_ts'),'required' => array())
	,'activity/episodes' => array(
		'order' => array('title','season','episode','actions','start_ts','end_ts')
		,'required' => array('title','season','episode'))
	,'activity/friends' => array(
		'order' => array('types','actions','start_ts','end_ts')
		,'required' => array())
	,'activity/movies' => array(
		'order' => array('title','actions','start_ts','end_ts')
		,'required' => array('title'))
	,'activity/seasons' => array(
		'order' => array('title', 'season','actions','start_ts','end_ts')
		,'required' => array('title', 'season'))
	,'activity/shows' => array(
		'order' => array('title','actions','start_ts','end_ts')
		,'required' => array('title'))
	,'activity/user' => array(
		'order' => array('username','actions','start_ts','end_ts')
		,'required' => array('username'))
	,'calendar/premieres' => array(
		'order' => array('date','days')
		,'required' => array())
	);