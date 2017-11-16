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
		$uri = ltrim( $_SERVER['PATH_INFO'], '/' );
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
}