<?php namespace Wubs\Trakt\Activity;

use Wubs\Trakt\HttpBot;

class Activity extends HttpBot{

	/**
	 * Runs when calling Trakt::get('activity/community');
	 * @return Wubs\Trakt\Activity\Community 
	 * Object with specific methods for the Community call
	 */
	public function community(){
		$this->uriOrder = array('types', 'actions', 'start_ts', 'end_ts');
		return $this->setUri('activity/community.json');
	}

	/**
	 * Runs when calling Trakt::get('activity/episodes');
	 * @return Wubs\Trakt\Activity\Episodes 
	 * Object with specific methods for the Episodes call
	 */
	public function episodes(){
		$this->uriOrder = array('title', 'season', 'episode', 'actions', 'start_ts', 'end_ts');
		$this->required = array('title', 'season', 'episode');
		return $this->setUri('activity/episodes.json');
	}

	public function friends(){
		$this->uriOrder = array('types','actions','start_ts','end_ts');
		return $this->setUri('activity/friends.json')->setHTTPType('post');
	}

	public function movies(){
		$this->uriOrder = array('title','actions','start_ts','end_ts');
		$this->required = array('title');
		return $this->setUri('activity/movies.json');
	}

	public function seasons(){
		$this->uriOrder = array('title','season','actions','start_ts','end_ts');
		$this->required = array('title', 'season');
		return $this->setUri('activity/seasons.json');
	}

}