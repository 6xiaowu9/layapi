<?php 
namespace LayAPI\Http;

/**
* 路由类
*/
class Route
{
	static public $routes = array();
	function __construct()
	{
		
	}
	static public function get( $uri = null , $callback = null){
		if( empty( $uri )){
  			throw new \Exception("未指定URI！");
		}
		if( empty( $callback )){
  			throw new \Exception("未指定CALLBACK！");
		}
		$route = new \stdClass();
		$route->uri = $uri;
		$route->callback = $callback;
		self::$routes[$uri] = $route;
	}
	static public function group( $uri = null , $callback = null){
		if( empty( $uri )){
  			throw new \Exception("未指定URI！");
		}
		if( empty( $callback )){
  			throw new \Exception("未指定CALLBACK！");
		}
		$route = new \stdClass();
		$route->uri = $uri;
		$route->callback = $callback;
		self::$routes[$uri] = $route;
	}
}