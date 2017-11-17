<?php 

namespace LayAPI\Http;

interface RouteInterface
{
	public function group();
	public function get();
	public function post();
	public function put();
	public function delete();
}