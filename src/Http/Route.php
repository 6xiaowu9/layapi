<?php 
namespace LayAPI\Http;

use stdClass;
use Exception;
use LayAPI\Http\RouterInterface;
/**
* 路由类
*/
class Route implements RouterInterface
{
	public static $routes = [];
	public static $groupStack = [];
	function __construct()
	{
		
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
		RouteGroup::aspect();
		// dump($this);
		
		// $this->updateGroup( $attributes );
		// return $this;
	}
	public function put()
	{
		
	}
	public function post()
	{

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