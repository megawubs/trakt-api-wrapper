<?php namespace Wubs\Trakt\Activity;

use Wubs\Trakt\HttpBot;

class Activity extends HttpBot{

	/**
	 * Runs when calling Trakt::get('activity/community');
	 * @return Wubs\Trakt\Activity 
	 * Object
	 */
	public function community(){
		return $this->setUri('activity/community.json')
		->setUriOrder(array('types', 'actions', 'start_ts', 'end_ts'));
	}

	/**
	 * Runs when calling Trakt::get('activity/episodes');
	 * @return Wubs\Trakt\Activity
	 * Object
	 */
	public function episodes(){
		return $this->setUri('activity/episodes.json')
		->setUriOrder(array('title', 'season', 'episode', 'actions', 'start_ts', 'end_ts'))
		->setRequired(array('title', 'season', 'episode'));
	}

	/**
	 * Runs when calling Trakt::get('activity/friends');
	 * @return Wubs\Trakt\Activity
	 * Object
	 */
	public function friends(){
		return $this->setUri('activity/friends.json')->setHTTPType('post')
		->setUriOrder(array('types','actions','start_ts','end_ts'));
	}

	/**
	 * Runs when calling Trakt::get('activity/movies');
	 * @return Wubs\Trakt\Activity
	 * Object
	 */
	public function movies(){
		return $this->setUri('activity/movies.json')
		->setUriOrder(array('title','actions','start_ts','end_ts'))
		->setRequired(array('title'));
	}

	/**
	 * Runs when calling Trakt::get('activity/seasons');
	 * @return Wubs\Trakt\Activity
	 * Object
	 */
	public function seasons(){
		return $this->setUri('activity/seasons.json')
		->setUriOrder(array('title','season','actions','start_ts','end_ts'))
		->setRequired(array('title', 'season'));
	}

	/**
	 * Runs when calling Trakt::get('activity/shows');
	 * @return Wubs\Trakt\Activity
	 * Object
	 */
	public function shows(){
		return $this->setUri('activity/shows.json')
		->setUriOrder(array('title','actions','start_ts','end_ts'))
		->setRequired(array('title'));
	}

	/**
	 * Runs when calling Trakt::get('activity/user');
	 * @return Wubs\Trakt\Activity
	 * Object
	 */
	public function user(){
		return $this->setUri('activity/user.json')
		->setUriOrder(array('username','actions','start_ts','end_ts'))
		->setRequired(array('username'));
	}


}