<?php namespace Wubs\Trakt;

class Show{
	private $data = array();

	private $identifier;

	public function __construct($identifier, $extended = false){
		if(is_string($identifier)){
			if(!strstr($identifier, '-')){
				$identifier = str_replace(' ', '-', $identifier);
			}
		}
		$this->identifier = $identifier;
		$show = Trakt::get('show/summary')->setTitle($identifier);
		if($extended){
			$show->setExtended($extended);
		}
		$this->data['show/summary'] = $show->run();
	}

	public function __get($key){
		if(array_key_exists($key, $this->data['show/summary'])){
			return $this->data['show/summary'][$key];
		}
	}

	public function seasons(){
		$call = 'show/seasons';
		if(!$this->callHasMade($call)){
			$seasons = Trakt::get($call)->setTitle($this->identifier)->run();
			for ($i=0; $i <count($seasons); $i++) { 
				$seasons[$i]['data'] = Trakt::get('show/season')->setTitle($this->identifier)->setSeason($seasons[$i]['season'])->run();
			}
			return $this->setData($call, $seasons);
		}
		else{
			return $this->data[$call];
		}
	}

	public function season($number){
		$call = 'show/season';
		if(!$this->callHasMade('show/seasons')){ //note, i check for seasonS here!
			if(!$this->callHasMade($call) && !array_key_exists($this->data[$call], $number)){
				$season = Trakt::get($call)->setTitle($this->identifier)->setSeason($number)->run();
				return $this->setData($call, array($number=>$season));
			}
			else{
				return $this->data[$call][$number];
			}
		}
		else{
			return $this->data['show/seasons'][$number];
		}
	}

	private function callHasMade($call){
		return array_key_exists($call, $this->data);
	}

	private function setData($call, $data){
		$this->data[$call] = $data;
		return $data;
	}
}