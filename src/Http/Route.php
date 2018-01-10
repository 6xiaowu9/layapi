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
	}
	public function get( $attributes = null, $function = null, $parent = null )
	{
		Route::loadRouter($parent, 'GET', $attributes, $function );
	}
    public function group( $attributes = null, $routes = null, $parent = null )
	{
		Route::loadGroup($parent, $attributes, $routes );
	}
	public function put()
	{
		Route::loadRouter($parent, 'PUT', $attributes, $function );
	}
	public function post( $attributes = null, $function = null, $parent = null )
	{
		Route::loadRouter($parent, 'POST', $attributes, $function );
	}
	public function delete()
	{
		Route::loadRouter($parent, 'DELETE', $attributes, $function );
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
		$route->group();
		$routes($route);
		if( $parent )
			$parent->addGroup($route);
		else
			Route::$routes = $route;
	}
}