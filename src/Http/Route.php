<?php 
namespace LayAPI\Http;

use stdClass;
use Exception;
use LayAPI\Model\RouteModel;
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

    public function group( $attributes = null, $routes = null, $parent = null )
	{
		Route::loadGroup($parent, $attributes, $routes );
	}
	
	/**
	 * 创建一个 GET 路由
	 * @param  string $attributes 属性参数
	 * @param  string $function   callback
	 * @param  string $parent     上级目录
	 */
	public function get( $attributes = null, $function = null, $parent = null )
	{
		Route::loadRouter($parent, 'GET', $attributes, $function );
	}

	/**
	 * 创建一个 POST 路由
	 * @param  string $attributes 属性参数
	 * @param  string $function   callback
	 * @param  string $parent     上级目录
	 */
	public function post( $attributes = null, $function = null, $parent = null )
	{
		Route::loadRouter($parent, 'POST', $attributes, $function );
	}

	/**
	 * 创建一个 PUT 路由
	 * @param  string $attributes 属性参数
	 * @param  string $function   callback
	 * @param  string $parent     上级目录
	 */
	public function put()
	{
		Route::loadRouter($parent, 'PUT', $attributes, $function );
	}

	/**
	 * 创建一个 DELETE 路由
	 * @param  string 	$attributes 属性参数
	 * @param  callback $function   callback
	 * @param  string 	$parent     上级目录
	 */
	public function delete()
	{
		Route::loadRouter($parent, 'DELETE', $attributes, $function );
	}

	/**
	 * 加载进路由管理者
	 * @param  RouteModel 	$parent     父级路由
	 * @param  string 		$methods    类型
	 * @param  sting 		$attributes 路由属性
	 * @param  callback 	$function   回调
	 */
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

	/**
	 * 加载进路由组管理者
	 * @param  RouteModel $parent     父级路由
	 * @param  string $methods    类型
	 * @param  sting $attributes 路由属性
	 * @param  callback $function   回调
	 */
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