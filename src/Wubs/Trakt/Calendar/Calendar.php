<?php namespace Wubs\Trakt\Calendar;

use Wubs\Trakt\HttpBot;
class Calendar extends HttpBot{

	public function premieres(){
		return $this->setUri('calendar/premieres.json')
		->setUriOrder(array('date','days'));
	}
}