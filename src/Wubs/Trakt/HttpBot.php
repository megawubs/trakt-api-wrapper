<?php namespace Wubs\Trakt;

class HttpBot{

	protected $params;

	protected $type = 'get';

	public $url = 'http://api.trakt.tv/';

	public function setParams($params){
		if(is_array($params)){
			$this->params = json_encode($params);
			return $this;
		}
		$this->params = $params;
		return $this;
	}

	/**
	 * execute the http post or get request
	 * @return string the result from the request
	 */
	public function execute(){
		$curl = curl_init($this->url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
		if($this->type == 'post'){
			if(is_array($this->params)){
				$content = json_encode($this->params);
			}
			else $content = $this->params;
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
		}
		$json_response = curl_exec($curl);
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		if($status != 200){
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
}