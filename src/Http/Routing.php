<?php 
namespace LayAPI\Http;

use Closure;
use Exception;
use LayAPI\Http\Route;
use LayAPI\Http\Response;
use LayAPI\Model\RouteModel;
use LayAPI\Foundation\IO;

/**
* 路由监听
*/
class Routing
{
	
	public static function start() 
	{
		$path = explode( '/', ltrim( $_SERVER['PATH_INFO'], '/' ) );
		$route = Routing::matchingRouter( Route::$routes, $path );
		Routing::checkRoute( $route );
		$closure = $route->getCallback();
		if( $closure instanceof Closure ){
			call_user_func( $closure );
		}else{
			if( !$closure )
			Routing::checkClosure( $closure );
			$callback = explode('@', $closure);
			$class = ltrim($route->getNamespace().'\\'.trim($callback[0], '\\').'Controller', '\\');
			$class = new $class();
			$action = $callback[1];
			if( is_callable([$class, $action], false, $callable_name) ){
				$response = $class->$action();
				IO::output($response);
			}else
				throw new Exception("the Function: ".$action." of Class: ".$class." does not exist!");

		}
	}

	public function matchingRouter( $routes, $path_arr , $route = null )
	{
		$route = $route ?? new RouteModel();
		if( is_array( $routes ) ){
			if( array_key_exists( $path_arr[0], $routes ) || 
				( $path_arr[0] == '' && 
					array_key_exists( $path_arr[0] = 'index', $routes ) ) )
				$routes = $routes[$path_arr[0]];
			else
				return false;
		}else{
			$confirm = $path_arr[0] == ''  && 
			$routes->getPrefix() == 'index';
			if( $path_arr[0] != $routes->getPrefix() && !$confirm )
				return false;
			else
				$confirm ? $route->setPrefix( $routes->getPrefix() ) : false;
		}

		$result = array_shift( $path_arr );
		$prefix = $route->getPrefix();
		if( $prefix ){
			$route->setPrefix( $prefix.'/'.$result );
			$route->setNameSpace( $route->getNameSpace().$routes->getNameSpace() );
			$route->setGroup( $routes->getGroup() );
			$route->group( $routes->isGroup() );
			$method = $routes->getMethod();
			if( $method ){
				$route->setMethod( $method );
				$route->setCallback( $routes->getCallback() );
			}
		}else
			$route = $routes;
		if( $path_arr )
			$route = Routing::matchingRouter( $routes->getGroup(), $path_arr, $route );
		return $route;
	}

	private function checkRoute( &$route )
	{
		if( !$route )
			throw new Exception("Callback not found!");
		Routing::checkMethod( $route );
		Routing::checkGroup( $route );
	}
	private function checkMethod( &$route )
	{
		if( $route->getMethod() != $_SERVER['REQUEST_METHOD'] )
			throw new Exception("the Function: ".$route->getPrefix()." request method is {$_SERVER['REQUEST_METHOD']} of Class: ".$route->getNamespace()." does not exist!");
	}
	private function checkGroup( &$route )
	{
		if( $route->getGroup() )
			throw new Exception("the Callback: ".$route->getPrefix()." of Group: ".$route->getNamespace()." does not exist!");
	}
	private function checkClosure( &$closure )
	{
		if( !$closure )
			throw new Exception("Closure not found!");
	}

}