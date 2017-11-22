<?php 
namespace LayAPI\Http;

use Closure;
use Exception;
use LayAPI\Http\Route;
use App\Controller\IndexController;

/**
* 路由监听
*/
class Routing
{
	
	public static function start() 
	{
		$path = explode( '/', ltrim( $_SERVER['PATH_INFO'], '/' ) );
		$route = Routing::matchingRouter( Route::$routes, $path );
		if( $route ){
			$closure = $route->getCallback();
			if( $closure instanceof Closure )
				call_user_func( $closure );
			else{
				$callback = explode('@', $closure);
				$class = ltrim($route->getNamespace().'\\'.trim($callback[0], '\\').'Controller', '\\');
				$action = $callback[1];
				call_user_func([$class, $action]);
			}
		}else
			throw new Exception("不存在路由");
	}

	public function matchingRouter( $routes, $path_arr , $route = null )
	{
		$route = $route ?? new RouteModel();
		// dump($route);
		if( is_array( $routes ) ){
			if( array_key_exists( $path_arr[0], $routes ) || ( $path_arr[0] == '' && array_key_exists( $path_arr[0] = 'index', $routes ) ) )	
				$routes = $routes[$path_arr[0]];
			else
				return false;
		}else{
			if( $path_arr[0] != $routes->getPrefix() && !( $path_arr[0] == ''  && $routes->getPrefix() == 'index') )
				return false;
		}
		$result = array_shift( $path_arr );
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
		return $route;
	}
}