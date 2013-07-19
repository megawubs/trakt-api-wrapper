<?php namespace Wubs\Trakt\Base;

use Wubs\Settings\Settings;
use Wubs\Trakt\Exceptions\TraktException;

class HttpBot extends Uri{

	protected $params = null;
	
	private $type     = 'get';
	
	protected $url    = 'http://api.trakt.tv/';
	
	private $response;

	public function __construct($uri){
		parent::__construct($uri);
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
	 * @return array      the response from the api 
	 * call mapped to an array
	 * @throws TraktExceptoin If api call fails to execute
	 */
	public function run($uri = ''){
		if($uri != ''){
			$this->setUri($uri);
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

	private function generateUrl(){
		$this->url .= $this->generateUri();
	}

	public function getResponse(){
		return $this->response;
	}

	/**
	 * Gets the full url
	 * @return string
	 */
	public function getUrl(){
		return $this->url.$this->generateUri();
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
}