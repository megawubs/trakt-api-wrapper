<?php namespace Wubs\Trakt\Media;


use Wubs\Trakt\Base\TraktClass;
use Wubs\Trakt\User;
use Wubs\Trakt\Exceptions\TraktException;

class Media extends TraktClass{
	protected $type;
	
	protected $user;

	protected $identifier;

	public function __construct($identifier){
		$this->setIdentifier($identifier);
	}

	/**
	 * Sets the identifier for the current media
	 * @param string $identifier
	 */
	private function setIdentifier($identifier){
		if(is_string($identifier)){
			if(!strstr($identifier, '-')){
				$identifier = str_replace(' ', '-', $identifier);
			}
		}
		$this->identifier = $identifier;
	}

	/**
	 * Sets $this->user
	 * @param User $user an existing user object
	 * @return $this
	 */
	public function setUser(User $user){
		$this->user = $user;
		return $this;
	}

	/**
	 * Returns the current user
	 * @return Wubs\Trakt\User
	 */
	public function getUser(){
		return $this->user;
	}

	/**
	 * Makes a new user instance and sets $this->user to it
	 * @param  string $name     the name of the user
	 * @param  string $password sha1 hash of the users password
	 * @return Wubs\Trakt\User
	 */
	public function makeUser($name, $password = null){
		$this->user = new User($name, $password);
		return $this->user;
	}

	/**
	 * Resolves the user object. Returns this->user if it matches
	 * the given username. If not, it'll create a new user instance.
	 * When $this->user doesn't exists it'll create a new instance of User.
	 * @param  string $username
	 * @param  string $password sha1 hash of the user's password
	 * @throws \Wubs\Trakt\Exceptions\TraktException If the user can't be resolved.
	 * @return Wubs\Trakt\User
	 */
	public function resolveUser($username = null, $password = null){
		if($username != null){
			if(is_object($this->user)){
				//check if the given username is the same as this->user
				if($this->user->username == $username){
					return $this->user;
				}
			}
			//create a new user object if the name doesn't match 
			//or when $this->user isn't set
			return $this->makeUser($username, $password);
		}
		else{ //return this->user when the given username is null
			if(is_object($this->user)){
				return $this->user;
			}
			else{ // throw an exception when we are unable to resove the user
				throw new TraktException("Unable to resolve user", 0);
			}
			
		}
	}
}