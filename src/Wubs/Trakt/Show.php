<?php namespace Wubs\Trakt;

class Show{
	/**
	 * Contains all data returned by trakt requests, where
	 * the key is the request uri
	 * @var array
	 */
	private $data = array();

	/**
	 * The shows slug or TVDB id
	 * @var mixed
	 */
	private $identifier;

	/**
	 * Initiates the Show by preforming the show/summary request
	 * all non found propertys will be searched in this array
	 * this will make $show->tile possible after $show = Trakt::show(153021);
	 * @param mixed  $identifier TVDB id or slug
	 * @param boolean $extended   get back extended information or not, defaults to false
	 */
	public function __construct($identifier, $extended = false){
		if(is_string($identifier)){
			if(!strstr($identifier, '-')){
				$identifier = str_replace(' ', '-', $identifier);
			}
		}
		$this->identifier = $identifier;
		$show = Trakt::get('show/summary')->setTitle($identifier);
		if($extended){
			$show->setExtended($extended);
		}
		$this->data['show/summary'] = $show->run();
	}

	/**
	 * Magical getter. 
	 *
	 * Searches the requested property in $this->data['show/summary']
	 * and returns it if it finds it.
	 * @param  string $key the name of the key
	 * @return mixed      the stored value of the key
	 */
	public function __get($key){
		if(array_key_exists($key, $this->data['show/summary'])){
			return $this->data['show/summary'][$key];
		}
	}

	/**
	 * Gets all seasons of the show with the episodes in the 'data' key of each season
	 * All episodes will me mapped to an Wubs\Trakt\Episode instance
	 *
	 * If the request has been made before, it'll simply return the stored
	 * value in $this->data[$request];
	 * @return array the mapped response from Trakt
	 */
	public function seasons(){
		$request = 'show/seasons';
		if(!$this->requestHasMade($request)){
			$seasons = Trakt::get($request)->setTitle($this->identifier)->run();
			for ($i=0; $i <count($seasons); $i++) { 
				$seasons[$i]['data'] = Trakt::get('show/season')->setTitle($this->identifier)->setSeason($seasons[$i]['season'])->run();
			}
			print_r($seasons);
			return $this->setData($request, $seasons);
		}
		else{
			return $this->data[$request];
		}
	}

	/**
	 * Gets the given season from trakt, with the season data 
	 * in the 'data' key. All Episodes are mapped to Wubs\Trakt\Episode
	 * @param  integer| $number the number of the season
	 * @return array         Mapped list of episodes for this season
	 */
	public function season($number){
		$request = 'show/season';
		if(!$this->requestHasMade('show/seasons')){ //note, i check for seasonS here!
			if(!$this->requestHasMade($request) && !array_key_exists($this->data[$request], $number)){
				$season = Trakt::get($request)->setTitle($this->identifier)->setSeason($number)->run();
				return $this->setData($request, array($number=>$season));
			}
			else{
				return $this->data[$request][$number];
			}
		}
		else{
			return $this->data['show/seasons'][$number];
		}
	}

	/**
	 * Checks if the given request has already been made
	 * by checking if $this->data has the provided 
	 * $request as a key.
	 * @param  string $request the uri for the request
	 * @return boolean       true when the key exists
	 */
	private function requestHasMade($request){
		return array_key_exists($request, $this->data);
	}

	/**
	 * Sets the data for $this->data
	 * @param string $request the uri for the request
	 * @param array $data the response or mapped from trakt.
	 */
	private function setData($request, $data){
		$this->data[$request] = $data;
		return $data;
	}
}