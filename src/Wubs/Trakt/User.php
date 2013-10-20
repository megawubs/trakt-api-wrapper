<?php namespace Wubs\Trakt;

use Wubs\Trakt\Exceptions\TraktException;
use Wubs\Trakt\Base\TraktClass;

class User extends TraktClass{
	protected $type = 'user';

	private $inputDateFormat = 'Y-m-d';

	private $password = null;

	public function __construct($username, $password = null){
		$this->setDataKey('profile');
		if($password != null){
			$this->password = $password;
		}
		$profile = $this->get('profile')->setUsername($username);
		$this->runAndSave($profile, 'array');
	}

	public function getCalendar($date = false, $days = false, $map = false){
		$calendar = $this->get('calendar/shows')->setUsername($this->username);
		// check if the date provided is a valid date
		if($date){
			if($this->checkDate($date)){
				$date = $this->convertDate();
				$calendar->setDate($date);
			}
		}
		$dates = $this->runAndSave($calendar, 'array');
		if($map){
			foreach ($dates as $date) {
				foreach ($date['episodes'] as $episode) {
					$this->mapEpisode($episode); //Episode object is a child of the show object...
				}
			}
		}
	}

	private function checkDate($date){
		$this->dateObject = \DateTime::createFromFormat($this->inputDateFormat, $date);
		$check = ($this->dateObject && (date_format($this->dateObject,$this->inputDateFormat) == $date)) ? true : false;
		if(!$check){
			throw new TraktException("Date provided is not valid", 1);
		}
		else{
			return true;
		}
	}

	private function convertDate(){
		return date_format($this->dateObject, $this->traktDateFormat);
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getPassword(){
		if($this->password != null){
			return $this->password;
		}
		else{
			throw new TraktException("Trying to access password while it isn't set", 1);
			
		}
	}

	public function getAuthParams(){
		return array('username'=>$this->username, 'password'=>$this->getPassword());
	}
}
?>