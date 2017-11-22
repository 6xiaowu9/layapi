<?php 
namespace LayAPI\Http;

use stdClass;
use Exception;
use LayAPI\Http\RouteProperty;
use LayAPI\Http\RouteInterface;
/**
* 路由类
*/
class Route implements RouteInterface
{
	public static $routes;
	public static $groupStack = [];
	function __construct()
	{
		$this->routes = new RouteModel();
		dump('123');
	}
	public function get( $uri = null , $callback = null)
	{
		if( empty( $uri )){
  			throw new Exception("未指定URI！");
		}
		if( empty( $callback )){
  			throw new Exception("未指定CALLBACK！");
		}
		$route = new stdClass();
		$route->uri = $uri;
		$route->callback = $callback;
		self::$routes[$uri] = $route;
	}
    public function group( $attributes = null, $routes = null, $parent = null )
	{
		Route::loadGroup($parent, $attributes, $routes );
	}
	public function put()
	{
		dump('ahdfkhsaksldf');
	}
	public function post( $attributes = null, $function = null, $parent = null )
	{
		Route::loadRouter($parent, 'POST', $attributes, $function );
	}
	public function delete()
	{

	}

	private function loadRouter( $parent = null, $methods, $attributes, $function )
	{
		$route = new RouteModel();
		if( is_array( $attributes ) )
			$route->setRouteAttributes( $attributes );
		else
			$route->setPrefix( $attributes );
		$route->setMethod( $methods );
		$route->setCallback( $function );
		$parent->addGroup( $route );
	}

	private function loadGroup( $parent = null, $attributes, $routes )
	{
		$route = new RouteModel();
		if( $attributes )
			if( is_array( $attributes ) )
				$route->setRouteAttributes( $attributes );
			else
				$route->setPrefix( $attributes );
		$route->isGroup();
		// var_dump($routes($route));exit;
		$routes($route);
		if( $parent )
			$parent->addGroup($route);
		else
			Route::$routes = $route;
	}
}