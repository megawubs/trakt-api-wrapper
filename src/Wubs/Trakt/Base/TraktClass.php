<?php namespace Wubs\Trakt\Base;

use Wubs\Trakt\Media\Episode;
use Wubs\Trakt\Media\Season;
use Wubs\Trakt\Media\Show;
use Wubs\Trakt\Base\HttpBot;
use Wubs\Trakt\Exceptions\TraktException;
use Wubs\Trakt\Trakt;

class TraktClass{
	/**
	 * Contains all data returned by trakt requests, where
	 * the key is the request uri
	 * @var array
	 */
	protected $data = array();

	protected $type;

	protected $dataKey;

	protected $traktDateFormat = 'Ymd';

	/**
	 * The shows slug or TVDB id
	 * @var mixed
	 */
	protected $identifier;

	protected function setDataKey($key){
		$this->dataKey = $this->type . '/' . $key; 
	}
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
		echo "SetData for: $request\n";
		// $request = $this->type . '/' . $request;
		$type = (is_null($type)) ? gettype($data) : $type;
		if(array_key_exists($request, $this->data)){
			$this->data[$request][$type] = $data;
			var_dump($data);
		}
		else{
			$this->data[$request] = array("$type" => $data);
		}
		
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
		$dataKey = $this->dataKey;
		$data = $this->data[$dataKey]['array'];
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
		echo "$uri \n";
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

	/**
	 * Helper function to check if the response was success
	 * @param  array $res
	 * @return boolean
	 */
	protected function checkStatus($res){
		return ($res['status'] == 'success') ? true : false;
	}

	/**
	 * Helper function for posting to trakt
	 * @param  string $uri    the api end point
	 * @param  array|string $params the parameters for the post request. either an array or a json srting
	 * @return array         the response from trakt
	 */
	protected function post($uri, $params){
		return Trakt::post($this->type.'/'.$uri)->setParams($params)->run();
	}

	protected function get($uri){
		return Trakt::get($this->type.'/'.$uri);
	}
}