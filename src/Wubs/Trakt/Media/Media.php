<?php namespace Wubs\Trakt\Media;

class Media{
	/**
	 * Contains all data returned by trakt requests, where
	 * the key is the request uri
	 * @var array
	 */
	protected $data = array();

	/**
	 * The shows slug or TVDB id
	 * @var mixed
	 */
	protected $identifier;

	protected $dataKey;

	public function __construct($identifier){
		if(is_string($identifier)){
			if(!strstr($identifier, '-')){
				$identifier = str_replace(' ', '-', $identifier);
			}
		}
		$this->identifier = $identifier;
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
		if(array_key_exists($key, $this->data[$this->dataKey]['array'])){
			return $this->data[$this->dataKey]['array'][$key];
		}
	}
}