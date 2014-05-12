<?php namespace Wubs\Trakt\Interfaces;

interface HttpBotInterface{
	public function __construct(UriInterface $uri);

	public function setParams($params);

	public function run($uri = '');

	public function execute();

	public function setHTTPType($type);

	public function setUri($uri);

	public function getResponse();

	public function getUrl();
	
	public function getHTTPType();

	public function getParameters();

	public function getUri();

	public function __call($name, $params);
}