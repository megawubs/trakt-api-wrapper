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
		// return new Community();
	}

	/**
	 * Runs when calling Trakt::get('activity/episodes');
	 * @return Wubs\Trakt\Activity\Episodes 
	 * Object with specific methods for the Episodes call
	 */
	public function episodes(){
		return new Episodes();
	}

	public function friends(){
		return new Friends();
	}

	public function movies(){
		return new Movies();
	}

	public function seasons(){
		return new Seasons();
	}

}