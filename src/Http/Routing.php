<?php 
namespace LayAPI\Http;

use Closure;
use Exception;
use LayAPI\Http\Route;

/**
* 路由监听
*/
class Routing
{
	
	function __construct()
	{
		# code...
	}

	public static function start() 
	{
		$path = explode( '/', ltrim( $_SERVER['PATH_INFO'], '/' ) );
		// dump($path);
		// dump(Route::$routes);

		$closure = Routing::matchingRouter( Route::$routes, $path );
		// dump($closure);
		if( $closure )
			call_user_func( $closure->getCallback() );
		else
			throw new Exception("不存在路由");

		exit;


		if( isset( Route::$routes[$uri] ) ){
			$route = Route::$routes[$uri];
			if ( ($route->callback) instanceof Closure ) {
				$callback = $route->callback;
				echo $callback();
			}else{
				throw new Exception("回调不是一个闭包");
			}

		}else{
			
			throw new Exception("不存在路由");
		}
	}

	public function matchingRouter( $routes, $path_arr , $route = null )
	{
		$route = $route ?? new RouteModel();
		// dump($route);
		if( is_array( $routes ) ){
			if( array_key_exists( $path_arr[0], $routes ) )	
				$routes = $routes[$path_arr[0]];
			else
				return false;
		}else{
			if( $path_arr[0] != $routes->getPrefix() )
				return false;
		}
		$result = array_shift( $path_arr);
		$prefix = $route->getPrefix();
		if( $prefix ){
			$route->setPrefix( $prefix.'/'.$result );
			$route->setNameSpace( $route->getNameSpace().$routes->getNameSpace() );
			$method = $routes->getMethod();
			if( $method ){
				$route->setMethod( $method );
				$route->setCallback( $routes->getCallback() );
			}
		}else{
			$route = $routes;
		}
		if( $path_arr ){
			$route = Routing::matchingRouter( $routes->getGroup(), $path_arr, $route );
		}
		// dump($route);exit;
		return $route;
	}
}