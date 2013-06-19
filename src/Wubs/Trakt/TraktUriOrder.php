<?php namespace Wubs\Trakt;

return array(
	'account/create' => array(
			'order'     => array()
			,'required' => array()
			, 'format'  => false
		)
	,'account/settings' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'account/test' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'activity/community' => array(
			'order'     => array('types','actions','start_ts','end_ts')
			,'required' => array()
			,'format'   => 'json'
		)
	,'activity/episodes' => array(
			'order'     => array('title','season','episode','actions','start_ts','end_ts')
			,'required' => array('title','season','episode')
			,'format'   => 'json'
		)
	,'activity/friends' => array(
			'order'     => array('types','actions','start_ts','end_ts')
			,'required' => array()
			,'format'   => 'json'
		)
	,'activity/movies' => array(
			'order'     => array('title','actions','start_ts','end_ts')
			,'required' => array('title')
			,'format'   => 'json'
		)
	,'activity/seasons' => array(
			'order'     => array('title', 'season','actions','start_ts','end_ts')
			,'required' => array('title', 'season')
			,'format'   => 'json'
		)
	,'activity/shows' => array(
			'order'     => array('title','actions','start_ts','end_ts')
			,'required' => array('title')
			,'format'   => 'json'
		)
	,'activity/user' => array(
			'order'     => array('username','actions','start_ts','end_ts')
			,'required' => array('username')
			,'format'   => 'json'
		)
	,'calendar/premieres' => array(
			'order'     => array('date','days')
			,'required' => array()
			,'format'   => 'json'
		)
	);