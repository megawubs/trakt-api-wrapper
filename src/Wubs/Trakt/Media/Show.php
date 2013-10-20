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

	protected $type = 'show';
	/**
	 * Initiates the Show by preforming the show/summary request
	 * all non found propertys will be searched in this array
	 * this will make $show->tile possible after $show = Trakt::show(153021);
	 * @param mixed  $identifier TVDB id or slug
	 * @param boolean $extended   get back extended information or not, defaults to false
	 */
	public function __construct($identifier, $extended = false){
		parent::__construct($identifier);
		$request = 'summary';
		$show = $this->get($request)->setTitle($this->identifier);
		if($extended){
			$show->setExtended($extended);
		}
		$this->setDataKey($request);
		$this->runAndSave($show, 'array');
		// $this->setData($request, $show->run(), 'array');
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
		$uri = 'seasons';
		$request = $this->get($uri)->setTitle($this->identifier);
		$seasons = $this->runAndSave($request, 'array');
		if($map){
			return $this->mapSeasons($seasons);
		}
		else{
			return $seasons;
		}
	}

	/**
	 * Gets the given season from trakt, with the season data
	 * in the 'data' key. All Episodes are mapped to Wubs\Trakt\Episode
	 * @param  integer $number the number of the season
	 * @param bool $map
	 * @return array         Mapped list of episodes for this season
	 */
	public function season($number, $map = true){
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
		$comments = $this->get('comments')->setTitle($this->identifier);
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
	 * @param $season
	 * @param $episode
	 * @param null $message
	 * @param  string $username
	 * @param  string $password
	 * @param array $shared
	 * @return bool    Indicator if the checkin was success or not
	 */
	public function checkIn($season, $episode, $message = null, $username = null, $password = null, array$shared = array()){
		$user = $this->resolveUser($username, $password);
		$data = $this->getData($this->dataKey, 'array');
		$params = array(
			'username'=>$user->username
			,'password'=>$user->getPassword()
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
		$res = $this->post('checkin', $params);
		return $this->checkStatus($res);
	}

	/**
	 * Cancels the check-in
	 * @param  string $username
	 * @param  string $password
	 * @return boolean           indicator if cancelCheckin was success 
	 */
	public function cancelCheckIn($username = null, $password = null){
		$user = $this->resolveUser($username, $password);
		$params = array('username'=>$user->username, 'password'=>$user->getPassword());
		$res = $this->post('cancelcheckin', $params);
		return $this->checkStatus($res);
	}

	public function watching($season, $episode, $progress, $username = null, $password = null){
		$user = $this->resolveUser($username, $password);
		$data = $this->getData($this->dataKey, 'array');
		$params = array(
			'username'=>$user->username
			,'password'=>$user->getPassword()
			,'season'=> $season
			,'episode' => $episode
			,'imdb_id'=> $data['imdb_id']
			,'tvdb_id' => $data['tvdb_id']
			,'title' => $data['title']
			,'year' => $data['year']
			,'plugin_version'=> Trakt::$version
			,'progress' => $progress
		);
		$res = $this->post('watching', $params);
		return $this->checkStatus($res);
	}

	public function cancelWatching($username = null, $password = null){
		$user = $this->resolveUser($username, $password);
		$res = $this->post('cancelwatching', $user->getAuthParams());
		return $this->checkStatus($res);
		
	}
}