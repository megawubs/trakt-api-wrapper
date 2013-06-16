<?php namespace Wubs\Settings;

class Settings{

	/**
	 * the location of the settings file
	 * @var string
	 */
	private $file;

	/**
	 * The settings mapped to a object
	 * @var stdObject
	 */
	private $settings;
	/**
	 * The json string for the settings
	 * @var string
	 */
	private $baseSettingString = '{"trakt":{"username":"","api":"","password":" ","email":""}}';

	/**
	 * Sets the file, and loads the settings from the file
	 */
	public function __construct(){
		$this->file = dirname(__FILE__).'/../../../settings/settings.json';
		$this->loadSettings();
	}

	/**
	 * Get the given setting from the settings file
	 * @param  string $name the name of the setting separated with dots
	 * @return string       the value of the setting
	 * @throws \Exception If requested setting doesn't exist
	 */
	public function get($name){
		$error = "Setting with name: $name not present in the settings";
		if(strstr($name, '.')){
			$settings = $this->parseSettingName($name);
			if($this->settingsExsists($settings)){
				return $this->prettify($this->settings->$settings[0]->$settings[1]);
			}
			else{
				throw new \Exception($error);
			}
		}
		else{
			if(property_exists($this->settings, $name)){
				return $this->settings->$name;
			}
			else{
				throw new \Exception($error);
			}
			
		}
	}

	/**
	 * Sets the given setting if it exists.
	 * @param string $name the name of the setting separated by dots
	 * @param mixed $val  the value for the setting
	 */
	public function set($name, $val){
		if(strstr($name, '.')){
			$settings = $this->parseSettingName($name);
			$this->settings->$settings[0]->$settings[1] = $val;
			return $this->write();
		}
		else{
			return false;
		}
	}

	/**
	 * Writes the settings object back to the file
	 * @return void
	 */
	private function write(){
		try{
			$handle = fopen($this->file, 'w+');
			$string = json_encode($this->settings);
			fwrite($handle, $string);
			$this->loadSettings();
			fclose($handle);
			return true;
		}
		catch(Exeption $e){
			return false;
		}
		
	}

	/**
	 * Resets the setting file
	 * @return void
	 */
	public function reset($settings = false){
		if(!$settings){
			$this->settings = json_decode($this->baseSettingString);
		}
		else{
			$this->settings = json_decode($settings);
		}
		return $this->write();
	}

	/**
	 * parses the name of the setting
	 * @param  string $name setting name seperated by dots
	 * @return array       root and sub setting name
	 */
	private function parseSettingName($name){
		$rootSetting = explode('.', $name)[0];
		$subSetting  = explode('.', $name)[1];
		return array($rootSetting, $subSetting);
	}

	/**
	 * checks if the provided setting exists
	 * @param  string $settings dotted string of setting to check
	 * @return bool           true when the setting can be set, false if not
	 */
	private function settingsExsists($settings){
		return (property_exists($this->settings, $settings[0]) && property_exists($this->settings->$settings[0],$settings[1]));
	}

	/**
	 * gets the content from $this->file and maps it 
	 * to an object
	 * @return void
	 */
	private function loadSettings(){
		if(is_readable($this->file)){
			$string = file_get_contents($this->file);
			$this->settings = json_decode($string);
		}
		else{
			$this->reset();
		}
	}

	/**
	 * prettify the object or string it's given
	 * @param  mixed $var the variable to prettify
	 * @return string      prettified string
	 */
	private function prettify($var){
		$str = '';
		if(is_object($var)){
			foreach ($var as $key => $value) {
				if(!is_object($value)){
					$str .= $key.' = '.$value;
					$str .="\n";
				}
				else{
					$str .= $key."\n";
					$str .= $this->prettify($value);
				}
			}
		}
		else{
			$str = $var;
		}
		return $str;
	}

	/**
	 * shows the complete settings file, prettified
	 * @return string $this->settings prettified as a string
	 */
	public function show(){
		return $this->prettify($this->settings);
	}
}