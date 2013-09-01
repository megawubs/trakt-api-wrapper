<?php namespace Wubs\Trakt\Base;

use Wubs\Trakt\Media\Episode;
use Wubs\Trakt\Media\Season;
use Wubs\Trakt\Media\Show;
use Wubs\Trakt\Base\HttpBot;
use Wubs\Trakt\Exceptions\TraktException;

class TraktClass{
	/**
	 * Contains all data returned by trakt requests, where
	 * the key is the request uri
	 * @var array
	 */
	protected $data = array();

	protected $dataKey;

	protected $traktDateFormat = 'Ymd';

	/**
	 * The shows slug or TVDB id
	 * @var mixed
	 */
	protected $identifier;

	/**
	 * Checks if the given request has already been made
	 * by checking if $this->data has the provided 
	 * $request as a key.
	 * @param  string $request the uri for the request
	 * @return boolean       true when the key exists
	 */
	protected function requestHasMade($request){
		return array_key_exists($request, $this->data);
	}

	/**
	 * Sets the data for $this->data
	 * @param string $request the uri for the request
	 * @param array $data the response or mapped from trakt.
	 */
	protected function setData($request, $data, $type = null){
		$type = (is_null($type)) ? gettype($data) : $type;
		$this->data[$request][$type] = $data;
		return $data;
	}

	protected function getData($request, $type){
		return $this->data[$request][$type];
	}

	protected function checkIfTypeIsInData($request, $type){
		return array_key_exists($type, $this->data[$request]);
	}

	/**
	 * Magical getter. 
	 *
	 * Searches the requested property in $this->data[$this->dataKey]
	 * and returns it if it finds it.
	 * @param  string $key the name of the key
	 * @return mixed      the stored value of the key
	 */
	public function __get($key){
		$data = $this->data[$this->dataKey]['array'];
		if(array_key_exists($key, $data)){
			return $data[$key];
		}
		elseif(array_key_exists('status', $data)){
			if($data['status'] == 'error'){
				throw new TraktException($data['message'], 0);
			}
		}
	}

	protected function runAndSave(HttpBot $bot, $type){
		$uri = $bot->getUri(true);
		if(!$this->requestHasMade($uri)){
			return $this->setData($uri, $bot->run(), $type);
		}
		else{
			return $this->getData($uri, $type);
		}
	}

	/**
	 * Maps all season in array to a Wubs\Trakt\Media\Season object
	 * @param  array $seasons A list of seasons
	 * @return array          A list of mapped season objects
	 */
	protected function mapSeasons($seasons){
		for ($i=0; $i < count($seasons); $i++) { 
			$seasons[$i] = new Season($this->identifier, $seasons[$i]);
		}
		return $seasons;
	}

	protected function mapEpisode($episodeData){
		// print_r($episodeData);
	}
}