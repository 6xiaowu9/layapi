<?php 
namespace LayAPI\Http;

/**
 * 后期再说
 */
class RouteServerProvider
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
}