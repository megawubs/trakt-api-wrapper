<?php namespace Wubs\Trakt\Base;

use Wubs\Trakt\Exceptions\TraktException;
use Wubs\Trakt\Interfaces\HttpBotInterface;

class HttpBot implements HttpBotInterface{

	protected $params = null;
	
	private $type     = 'get';
	
	protected $url    = 'http://api.trakt.tv/';
	
	private $response;

	public function __construct(Uri $uri){
		$this->uri = $uri;
		// parent::__construct($uri, $api);
	}

	public function setParams($params){
		if(is_array($params)){
			$this->params = json_encode($params);
			return $this;
		}
		$this->params = $params;
		return $this;
	}

	/**
	 * Runs the bot
	 * @param  string $uri the trakt api request string like
	 * 'account/test'
	 * @throws \Wubs\Trakt\Exceptions\TraktException
	 * @return array      the response from the api
	 * call mapped to an array
	 */
	public function run($uri = ''){
		if($uri != ''){
			$this->uri->setUri($uri);
		}
	
		if($this->execute()){
			return $this->response;
		}
		else{
			throw new TraktException("Failed requesting $this->url, got response: ".json_encode($this->response)." With parameters: ".$this->getParameters(), 1);
		}
	}

	/**
	 * execute the http post or get request
	 * @throws \Wubs\Trakt\Exceptions\TraktException
	 * @return string the result from the request
	 */
	public function execute(){
		$this->generateUrl();
		$curl = curl_init($this->url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
		if($this->type == 'post'){
			$content = (is_array($this->params) ? json_encode($this->params) : $this->params);
			if(!$content){
				throw new TraktException("Cannot execute request without parameters");
			}
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
		}
		$json_response = curl_exec($curl);
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$this->response = json_decode($json_response, true);
		curl_close($curl);
		if($status != 200){
			return false;
		}
		if(array_key_exists('status', $this->response)){
			if($this->response['status'] == 'failure'){
				throw new TraktException("API request failed, ".$this->response['error']);
			}
		}
		return true;
	}

	/**
	 * sets the type of the http request
	 * @param string $type get or post
	 * @throws \Wubs\Trakt\Exceptions\TraktException
	 * @return $this
	 */
	public function setHTTPType($type){
		$types = array('get', 'post');
		if(in_array($type, $types)){
			$this->type = $type;
			return $this;
		}
		else{
			throw new TraktException("Can't set http request type to $type");
		}
	}

	public function setUri($uri){
		$this->uri->setUri($uri);
	}

	private function generateUrl(){
		$this->url .= $this->uri->generateUri();
	}

	public function getResponse(){
		return $this->response;
	}

	/**
	 * Gets the full url
	 * @return string
	 */
	public function getUrl(){
		return $this->url;//.$this->uri->generateUri();
	}
	
	/**
	 * @return string post or get
	 */
	public function getHTTPType(){
		return $this->type;
	}

	/**
	 * Gets array of given parameters
	 * @return array the parameters as array
	 */
	public function getParameters(){
		if(!is_string($this->params)){
			return json_encode($this->params);
		}
		else{
			return $this->params;
		}
	}

	/**
	 * Makes comma separated list from array, with only
	 * the allowed items in $allowed
	 * @param $var
	 * @param $key
	 * @return string filtered string with comma's
	 */
	protected function filter($var, $key){
			return str_replace(' ', '', trim($var));
	}

	/**
	 * magic method, runs when method called isnt found. 
	 * checks based on the uri order if set* method can be called.
	 * @param string $name the name of the method
	 * @param array $params the parameters given to the method
	 * @return $this
	 * @throws TraktException If the called set* method isn't in uriOrder
	 * @throws TraktException If $name doesn't start with 'set'
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
			if(in_array($part, $this->uri->getUriOrder())){
				$this->uri->appendUri($part, $param);
				return $this;
			}
			//get last char to check if they are setting more of something
			elseif($part[strlen($part)-1] === 's'){ 
				$part = substr_replace($part, '', -1);
				if(in_array($part, $this->uri->getUriOrder())){
					$this->uri->appendUri($part, $param);
					return $this;
				}
			}
			else{
				throw new TraktException("Setting $part is not required for this call", 1);
			}
		}
		else{
			throw new TraktException("Called method '$name' does not exists", 0);
		}
	}

	public function getUri(){
		return $this->uri;
	}
}