<?php 

namespace LayAPI\Http;

interface RouterInterface
{
	public function group(array $attributes, $routes);
	public function get();
	public function post();
	public function put();
	public function delete();
}