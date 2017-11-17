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
    public function group(array $attributes, $routes)
	{
		$route = new RouteModel();
		if( $attributes )
			$route->setRouteProperty( $attributes );
		$route->isGroup();
		$routes();
		$this->routes = $route;
	}
	public function put()
	{
		dump('ahdfkhsaksldf');
	}
	public function post( $attributes = null, $function = null)
	{
		$route = new RouteModel();
		if( is_array( $attributes ) )
			$route->setRouteProperty( $attributes );
		else
			$route->setPrefix( $attributes );
		$route->setCallback( $function );
		dump($this);exit;
		return $route;
	}
	public function delete()
	{

	}
	private function updateGroup( $attributes )
	{
		if( ! empty($this->groupStack) ){
		}
		$this->groupStack[] = $attributes;
	}
}