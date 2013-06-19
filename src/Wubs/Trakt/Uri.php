<?php namespace Wubs\Trakt;

use Wubs\Trakt\Exceptions\TraktException;
class Uri{

	protected $uri = array();

	protected $uriOrderAndRequiredList = array();

	private $uriOrder = array();
	
	private $required = array();

	private $format;

	public function __construct($base){
		$this->setUriOrderAndRequired($base);
		$uri = (is_string($this->format)) ? $base.'.'.$this->format : $base;
		$this->setUri($uri);
	}

	protected function setUriOrderAndRequired($base){
		$dir = dirname(__FILE__);
		$this->uriOrderAndRequiredList = require $dir.'/TraktUriOrder.php';

		if(array_key_exists($base, $this->uriOrderAndRequiredList)){
			$this->setUriOrder($this->uriOrderAndRequiredList[$base]['order']);
			$this->setRequired($this->uriOrderAndRequiredList[$base]['required']);
			$this->setFormat($this->uriOrderAndRequiredList[$base]['format']);
		}
		else{
			throw new TraktException("The api request $base isn't implemented yet", 1);
			
		}
	}

	private function setUriOrder(array$order){
		$this->uriOrder = $order;
		return $this;
	}

	private function setRequired(array$required){
		$this->required = $required;
		return $this;
	}

	private function setFormat($format){
		$this->format = $format;
	}
	/**
	 * Sets the uri
	 * @param string $uri the first part of the uri
	 */
	public function setUri($uri){
		$this->appendUri('base', $uri);
		$this->appendUri('api', Trakt::setting('api'));
		return $this;
	}

	public function appendUri($part, $uri){
		$uri = str_replace(' ', '', $uri);
		$this->uri[$part] = $uri;
		return $this;
	}

	/**
	 * Adds the api key stored in the settings to the uri
	 */
	public function addApiToUri(){
		$api = Trakt::setting('api');
		return $this->appendUri('api', $api);
	}

	/**
	 * Makes comma separated list from array, with only
	 * the allowed items in $allowed
	 * @param  array $array   the array to map to commas
	 * @param  array $allowed the array with allowed values
	 * @return string          filtered string with comma's
	 */
	protected function filter($var, $key){
		if(($key != 'start_ts') && ($key != 'end_ts')){
			return str_replace(' ', '', trim($var));
		}
		else{
			date_default_timezone_set('UTC');
			return strtotime($var);
		}
	}
	/**
	 * Returns the formated uri
	 * @return string the uri formated based on $this->required
	 */
	public function getUri(){
		return $this->generateUri();
	}

	/**
	 * Gets the array representation of the uri
	 * @return array
	 */
	public function getUriArray(){
		return $this->uri;
	}
	/**
	 * Generates the uri. This function makes it possible
	 * to build the api request without thinking about the order
	 * @return string the uri formatted in the right order.
	 * @throws TraktException If required api request part isn't set
	 */
	protected function generateUri(){
		$uri = $this->uri['base'];
		$uri .='/'.$this->uri['api'];
		//check if start_ts is set when end_ts is set
		
		if(array_key_exists('end_ts', $this->uri)){
			if(!array_key_exists('start_ts', $this->uri)){
				throw new TraktException("Cannot add end date if start date isn't set", 1);
			}
		}
		//check if all required uri parts are set
		foreach ($this->required as $part) {
			if(!array_key_exists($part, $this->uri)){
				throw new TraktException("The parameter '$part' is required", 1);
			}
		}
		//build the uri based on the uri order
		foreach ($this->uriOrder as $part) {
			if(array_key_exists($part, $this->uri)){
				if(in_array($part, $this->uriOrder)){
					//lookup the index of the required api part
					$index = array_search($part, $this->uriOrder);
					if($index > 0){
						$previousIndex = $index-1;
						//check if the previous index isn't lower than 0
						if($previousIndex > -1){
							//get the value of the previous required api part
							$value = $this->uriOrder[$previousIndex];
							//check if the uri array has the previous required part
							if(!array_key_exists($value, $this->uri)){
								throw new TraktException("Cannot add '".$this->uriOrder[$index]."' because '".$this->uriOrder[$previousIndex]."' isn't set ");
							}
						}
					}
				}
				$uri .= '/'.$this->uri[$part];
			}
		}
		return $uri;
	}

	public function __call($name, $params){
		if(strstr($name, 'set')){
			$part = strtolower(substr($name, 3));
			$param = $this->filter($params[0], $part);
			if(in_array($part, $this->uriOrder)){
				return $this->appendUri($part, $param);
			}
			elseif($part[strlen($part)-1] === 's'){
				$part = substr_replace($part, '', -1);
				if(in_array($part, $this->uriOrder)){
					return $this->appendUri($part, $param);
				}
			}
			else{
				throw new TraktException("Setting $part is not required for this call", 1);
			}
		}
		else{
			throw new TraktException("Called method does not exists", 1);
		}
	}
}