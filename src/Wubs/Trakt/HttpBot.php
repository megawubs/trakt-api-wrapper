<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;
use Wubs\Trakt\Exceptions\TraktException;

class HttpBot extends Actions{

	protected $params = null;
	
	private $type     = 'get';
	
	protected $url      = 'http://api.trakt.tv/';
	
	private $uri        = array();
	
	private $response;
	
	private $apiAdded   = false;
	
	protected $uriOrder = array();
	
	protected $required = array();

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
	 *                    call mapped to an array
	 * @throws \Exceptoin If api call fails to execute
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
			if(is_array($this->params)){
				$content = json_encode($this->params);
			}
			else{
				$content = $this->params;
			}
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
	 * Sets the uri
	 * @param string $uri the first part of the uri
	 */
	public function setUri($uri){
		$this->uri['base'] = $uri;
		$this->addApiToUri();
		return $this;
	}

	/**
	 * sets the type of the http request
	 * @param string $type get or post
	 */
	public function setType($type){
		$types = array('get', 'post');
		if(in_array($type, $types)){
			$this->type = $type;
		}
		else{
			throw new TraktException("Can't set http request type to $type");
		}
	}

	/**
	 * Adds the api key stored in the settings to the uri
	 */
	public function addApiToUri(){
		$api = Trakt::setting('api');
		$this->appendUri('api', $api);
	}

	public function appendUri($part, $uri){
		$uri = str_replace(' ', '', $uri);
		$this->uri[$part] = $uri;
		return $this;
	}

	private function generateUrl(){
		$this->url .= $this->generateUri();
	}

	/**
	 * Generates the uri. This function makes it possible
	 * to build the api request without thinking about the order
	 * @return string the uri formatted in the right order.
	 * @throws TraktException If required api request part isn't set
	 */
	private function generateUri(){
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

	public function getResponse(){
		return $this->response;
	}

	/**
	 * Returns the formated uri
	 * @return string the uri formated based on $this->required
	 */
	public function getUri(){
		return $this->generateUri();
	}

	/**
	 * Gets the full url
	 * @return string
	 */
	public function getUrl(){
		return $this->url.$this->generateUri();
	}

	public function getType(){
		return $this->type;
	}

	public function getParameters(){
		if(!is_string($this->params)){
			return json_encode($this->params);
		}
		else{
			return $this->params;
		}
	}
}