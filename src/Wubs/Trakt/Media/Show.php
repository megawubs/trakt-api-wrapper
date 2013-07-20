<?php namespace Wubs\Trakt\Media;

use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Trakt;
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
		$request = 'show/seasons';
		if(!$this->requestHasMade($request)){
			$seasons = Trakt::get($request)->setTitle($this->identifier)->run();
			$seasons = $this->setData($request, $seasons, 'array'); //populates the 'array' key of $this->data[$request]
			if($map){
				$seasons = $this->mapSeasons($seasons);
				return $this->setData($request, $seasons, 'object'); //populates the 'object' key of $this->data[$request]
			}
			else{
				return $seasons;
			}
		}
		else{
			$seasons = $this->getData($request,'array');
			if($map){
				if($this->checkIfTypeIsInData($request, 'object')){
					$seasons = $this->getData($request, 'object');
				}
				else{
					$seasons = $this->mapSeasons($seasons);
				} 
			}
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

	public function comments($type = 'all'){
		$types = array('shouts', 'reviews', 'all');
		$comments = Trakt::get('show/comments')->setTitle($this->identifier);
		if(in_array($type, $types)){
			$comments->setType($type);
		}
		return $comments->run();

	}
	/**
	 * Maps all season in array to a Wubs\Trakt\Media\Season object
	 * @param  array $seasons A list of seasons
	 * @return array          A list of mapped season objects
	 */
	private function mapSeasons($seasons){
		for ($i=0; $i < count($seasons); $i++) { 
			$seasons[$i] = new Season($this->identifier, $seasons[$i]);
		}
		return $seasons;
	}
}