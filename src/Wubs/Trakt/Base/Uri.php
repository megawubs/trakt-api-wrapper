<?php namespace Wubs\Trakt\Base;

use Wubs\Trakt\Exceptions\TraktException;
use Wubs\Trakt\Trakt;;
class Uri{

	protected $uri = array();

	protected $uriOrderAndRequiredList = array();

	private $uriOrder = array();
	
	private $required = array();

	private $format;
	
	/**
	 * Initiates the uri object by getting a list
	 * of exsisting api requests, the order, required and
	 * format set per request.
	 * @param  string $base the api start point
	 */
	public function __construct($base){
		$this->setUriOrderAndRequired($base);
		$uri = (is_string($this->format)) ? $base.'.'.$this->format : $base;
		$this->setUri($uri);
	}
	
	/**
	 * gets the list with availble api calls and 
	 * stores them. Sets uriOrder and uriRequired based on
	 * $base
	 * @param  string $base the api start point
	 * @return void
	 * @throws TraktException If $base isn't in the api list
	 */
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

	/**
	 * Sets the uriOrder
	 * @param array $order
	 */
	private function setUriOrder(array$order){
		$this->uriOrder = $order;
		return $this;
	}

	/**
	 * Sets the required parts for the uri
	 * @param array $required list of requiered uri parts
	 */
	private function setRequired(array$required){
		$this->required = $required;
		return $this;
	}

	/**
	 * Sets the format for the uri
	 * @param string|bool $format the format or false if none
	 */
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

	/**
	 * appends the uri
	 * @param string $part the name of the uri part
	 * @param mixed $uri the value for the uri part
	 */
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
			return str_replace(' ', '', trim($var));
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
	/**
	 * magic method, runs when method called isnt found. 
	 * checks based on the uri order if set* method can be called.
	 * @param string $name the name of the method
	 * @param array $params the parameters given to the method
	 * @throws TraktException If the called set* method isnt in uriOrder
	 * @throws TraktException If $name doesnt start with 'set'
	 */
	public function __call($name, $params){
		//encode part if second parameter is set to true
		if(count($params) > 1){
			if($params[1] === true){
				$params[0] = urlencode($params[0]);
			}
		}
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
	
	public function getUriOrder(){
		return $this->uriOrder;
	}

	public function getUriRequired(){
		return $this->required;
	}
}