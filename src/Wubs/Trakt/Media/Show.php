<?php namespace Wubs\Trakt\Media;

use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Trakt;
use Wubs\Trakt\User;
/**
 * Show object that combines a lot of Trakt::get() and 
 * Trakt::post() commands together.
 *
 * Usage
 * $show = Trakt::show(153021); // TVDB id or slug
 * echo $show->title;
 * echo $show->year;
 * $seasons = $show->seasons(); //this will get all seasons with the episode information
 * $seasons = $show->seasons(false) //this will get the original unmapped response from trakt
 */
class Show extends Media{

	/**
	 * Initiates the Show by preforming the show/summary request
	 * all non found propertys will be searched in this array
	 * this will make $show->tile possible after $show = Trakt::show(153021);
	 * @param mixed  $identifier TVDB id or slug
	 * @param boolean $extended   get back extended information or not, defaults to false
	 */
	public function __construct($identifier, $extended = false){
		parent::__construct($identifier);
		$request = 'show/summary';
		$show = Trakt::get($request)->setTitle($this->identifier);
		if($extended){
			$show->setExtended($extended);
		}
		$this->dataKey = $request;
		$this->setData($request, $show->run(), 'array');
	}

	/**
	 * Gets all seasons of the show with the episodes in the 'data' key of each season
	 * All episodes will me mapped to an Wubs\Trakt\Episode instance
	 *
	 * If the request has been made before, it'll simply return the stored
	 * value in $this->data[$request];
	 * @param boolean $map flag to map or not to map
	 * @return array the mapped response from Trakt
	 */
	public function seasons($map = true){
		$uri = 'show/seasons';
		$request = Trakt::get($uri)->setTitle($this->identifier);
		$seasons = $this->runAndSave($request, 'array');
		if($map){
			$seasons = $this->mapSeasons($seasons);
			return $this->setData($uri, $seasons, 'object'); //populates the 'object' key of $this->data[$request]
		}
		else{
			return $seasons;
		}
	}

	/**
	 * Gets the given season from trakt, with the season data 
	 * in the 'data' key. All Episodes are mapped to Wubs\Trakt\Episode
	 * @param  integer $number the number of the season
	 * @return array         Mapped list of episodes for this season
	 */
	public function season($number, $map = true){
		$dataKey = 'show/season';
		$seasons = $this->seasons($map);
		foreach ($seasons as $season) {
			//make sure we can always access the season
			if($map){
				if($season->season == $number){
					return $season;
				}
			}
			else{
				if($season['season'] == $number){
					return $season;
				}
			}
		}
	}

	/**
	 * Returns array with comments from the show
	 * @param  string $type the type of review to get (all, shouts or reviews)
	 * @return array       the result from trakt.tv
	 */
	public function comments($type = 'all'){
		$types = array('shouts', 'reviews', 'all');
		$comments = Trakt::get('show/comments')->setTitle($this->identifier);
		if(in_array($type, $types)){
			$comments->setType($type);
		}
		return $comments->run();
	}

	/**
	 * A simple wrapper to get the shouts
	 * @return array the shouts from this show
	 */
	public function shouts(){
		return $this->comments('shouts');
	}

	/**
	 * A simple wrapper to get the reviews
	 * @return array the reviews for this show
	 */
	public function reviews(){
		return $this->comments('reviews');
	}

	/**
	 * Checks in to the show
	 * @param  string  $username
	 * @param  string  $password
	 * @return bool    Indicator if the checkin was success or not
	 */
	public function checkIn($username, $password, $season, $episode, $message, array$shared = array()){
		$data = $this->getData($this->dataKey, 'array');
		$params = array(
			'username'=>$username
			,'password'=>$password
			,'season'=> $season
			,'episode' => $episode
			,'imdb_id'=> $data['imdb_id']
			,'tvdb_id' => $data['tvdb_id']
			,'title' => $data['title']
			,'year' => $data['year']
			,'shared'=> $shared
			,'message' => $message
			,'app_version'=> Trakt::$version
		);
		
		$res = Trakt::post('show/checkin')->setParams($params)->run();
		return ($res['status'] == 'success') ? true : false;
	}

	/**
	 * Cancels the check-in
	 * @param  string $username
	 * @param  string $password
	 * @return boolean           indicator if cancelCheckin was success 
	 */
	public function cancelCheckIn($username, $password){
		$params = array('username'=>$username, 'password'=>$password);
		$res = Trakt::post('show/cancelcheckin')->setParams($params)->run();
		return ($res['status'] == 'success') ? true : false;
	}
}