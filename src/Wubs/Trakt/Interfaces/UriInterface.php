<?php namespace Wubs\Trakt\Interfaces;

interface UriInterface{
	public function __construct($base, $api);
	public function setUri($uri);
	public function appendUri($part, $uri);
	public function addApiToUri();
	public function getUri();
	public function getUriArray();

	public function generateUri();
}