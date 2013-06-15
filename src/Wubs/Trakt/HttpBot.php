<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;
class HttpBot{

	protected $params;

	protected $type = 'get';

	public $url = 'http://api.trakt.tv/';

	public $response;
	
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
	 *                    call mapped to a array
	 * @throws \Exceptoin If api call fails to execute
	 */
	public function run($uri){
		$this->setUri($uri);
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
		$this->addApiToUri();
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
		if($status != 200){
			curl_close($curl);
			$this->response = json_decode($json_response, true);
			return false;
		}
		curl_close($curl);
		$this->response = json_decode($json_response, true);
		return true;
	}

	public function setUri($uri){
		$this->url .= $uri;
	}

	public function setType($type){
		$types = array('get', 'post');
		if(in_array($type, $types)){
			$this->type = $type;
		}
	}

	private function addApiToUri(){
		$s = new Settings();
		$api = $s->get('trakt.api');
		$this->setUri('/'.$api);
	}

	public function getResponse(){
		return $this->response;
	}
}