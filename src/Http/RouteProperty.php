<?php 
namespace LayAPI\Http;

use LayAPI\Http\RoutePropertyInterface;
use LayAPI\Http\RouteServerProvider;

/*
	路由属性 不着急用
 */
class RouteProperty
{
	// 路由前缀
	public function prefix( $prefix )
	{
		return $this;
	}

	public function namespace()
	{
		return $this;
	}

    public function group($routes)
	{
		$args = $routes;
		// self::put();		
		// $this->updateGroup( $attributes );
	}
}