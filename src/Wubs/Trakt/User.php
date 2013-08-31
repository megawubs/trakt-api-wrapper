<?php namespace Wubs\Trakt;

use Wubs\Trakt\Exceptions\TraktException;
use Wubs\Trakt\Base\TraktClass;

class User extends TraktClass{

	private $inputDateFormat = 'Y-m-d';

	public function __construct($username){
		$this->dataKey = 'user/profile';
		$profile = Trakt::get($this->dataKey)->setUsername($username);
		$this->runAndSave($profile, 'array');
	}

	public function getCalendar($date = false, $days = false, $map = false){
		$calendar = Trakt::get('user/calendar/shows')->setUsername($this->username);
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
}
?>