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
	,'comment/episode' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'comment/movie' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'comment/show' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'genres/movies' => array(
			'order' => array()
			,'required' => array()
			,'format'   => 'json'
		)
	,'genres/shows' => array(
			'order' => array()
			,'required' => array()
			,'format'   => 'json'
		)
	,'lists/add' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'lists/delete' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'lists/items/add' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'lists/items/delete' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'lists/update' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'movie/cancelcheckin' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'movie/cancelwatching' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'movie/checkin' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'movie/comments' => array(
			'order'     => array('title','type')
			,'required' => array('title')
			,'format'   => 'json'
		)
	,'movie/scrobble' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'movie/seen' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'movie/library' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'movie/related' => array(
			'order'     => array('title','hidewatched')
			,'required' => array('title')
			,'format'   => 'json'
		)
	,'movie/summary' => array(
			'order'     => array('title')
			,'required' => array('title')
			,'format'   => 'json'
		)
	,'movie/unlibrary' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'movie/unseen' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'movie/unwatchlist' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'movie/watching' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'movie/watchingnow' => array(
			'order'     => array('title')
			,'required' => array('title')
			,'format'   => 'json'
		)
	,'movie/watchlist' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'movies/trending' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => 'json'
		)
	,'movies/updated' => array(
			'order'     => array('timestamp')
			,'required' => array()
			,'format'   => 'json'
		)
	,'network/approve' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'network/deny' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'network/follow' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'network/requests' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'network/deny' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'network/unfollow' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'rate/episode' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'rate/episodes' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'rate/movie' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'rate/movies' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'rate/show' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'rate/shows' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'rate/movie' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'recommendations/movies' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'recommendations/movies/dismiss' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'recommendations/shows' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'recommendations/shows/dismiss' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'search/episodes' => array(
			'order'     => array("query")
			,'required' => array("query")
			,'format'   => 'json'
		)
	,'search/movies' => array(
			'order'     => array("query")
			,'required' => array("query")
			,'format'   => 'json'
		)
	,'search/people' => array(
			'order'     => array("query")
			,'required' => array("query")
			,'format'   => 'json'
		)
	,'search/shows' => array(
			'order'     => array("query")
			,'required' => array("query")
			,'format'   => 'json'
		)
	,'search/users' => array(
			'order'     => array("query")
			,'required' => array("query")
			,'format'   => 'json'
		)
	,'server/time' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => 'json'
		)
	,'shows/trending' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => 'json'
		)
	,'shows/updated' => array(
			'order'     => array('timestamp')
			,'required' => array('timestamp')
			,'format'   => 'json'
		)
	,'show/cancelcheckin' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/cancelwatching' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/checkin' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/comments' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/cancelwatching' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/episode/comments' => array(
			'order'     => array('title', 'type')
			,'required' => array('title', 'type')
			,'format'   => 'json'
		)
	,'show/episode/library' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/episode/seen' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/episode/summary' => array(
			'order'     => array('title','season','episode')
			,'required' => array('title','season','episode')
			,'format'   => 'json'
		)
	,'show/episode/unlibrary' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/episode/unseen' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/episode/unwatchlist' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/episode/watchingnow' => array(
			'order'     => array('title','season','episode')
			,'required' => array('title','season','episode')
			,'format'   => 'json'
		)
	,'show/episode/watchlist' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/library' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/related' => array(
			'order'     => array('title','extended','hidewatched')
			,'required' => array('title')
			,'format'   => false
		)
	,'show/scrobble' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/season' => array(
			'order'     => array('title', 'season')
			,'required' => array('title', 'season')
			,'format'   => 'json'
		)
	,'show/season/library' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/season/seen' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/seasons' => array(
			'order'     => array('title')
			,'required' => array('title')
			,'format'   => 'json'
		)
	,'show/seen' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/summary' => array(
			'order'     => array('title','extended')
			,'required' => array('title')
			,'format'   => 'json'
		)
	,'show/unlibrary' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/unwatchlist' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/watching' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	,'show/watchingnow' => array(
			'order'     => array('title')
			,'required' => array('title')
			,'format'   => false
		)
	,'show/watchlist' => array(
			'order'     => array()
			,'required' => array()
			,'format'   => false
		)
	);