<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;
class HttpBot{

	protected $params;

	protected $type = 'get';

	public $url = 'http://api.trakt.tv/';

	private $uri = '';

	public $response;

	private $apiAdded = false;
	
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
			throw new \Exception("Failed requesting $this->url, got response: ".json_encode($this->response), 1);
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
				throw new \Exception("API request failed, ".$this->response['error']);
			}
		}
		return true;
	}

	public function setUri($uri){
		$this->uri = $uri;
		$this->addApiToUri();
		return $this;
	}

	public function setType($type){
		$types = array('get', 'post');
		if(in_array($type, $types)){
			$this->type = $type;
		}
	}

	public function addApiToUri(){
		$s = new Settings();
		$api = $s->get('trakt.api');
		if(!$this->apiAdded){
			$this->appendUri('/'.$api);
			$this->apiAdded = true;
		}
	}

	public function appendUri($uri){
		$this->uri .= $uri;
	}

	private function generateUrl(){
		$this->url .= $this->uri;
	}

	public function getResponse(){
		return $this->response;
	}

	public function getUri(){
		return $this->uri;
	}

	public function getUrl(){
		return $this->url;
	}
}