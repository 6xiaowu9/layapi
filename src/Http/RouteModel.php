<?php 
namespace LayAPI\Http;

/**
* 路由模型类
*/
class RouteModel
{
	// 请求方式
	private $method;

	// 前缀
	private $prefix;

	// 命名空间
	private $namespace;

	// 执行方法
	private $callback;

	// 是否是路由组
	private $isGroup = false;

	// 路由组
	private $group = [];

	/**
	 * 设置前缀
	 * @param string $prefix 路由前缀
	 */
	public function setPrefix( string $prefix )
	{
		$this->prefix = $prefix;
	}

	/**
	 * 获得前缀
	 */
	public function getPrefix()
	{
		return trim($this->prefix, '/');
	}

	/**
	 * 设置请求类型
	 * @param string $method 路由请求类型
	 */
	public function setMethod( string $method )
	{
		$this->method = $method;
	}

	/**
	 * 获得请求类型
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * 设置命名空间
	 * @param string $prefix 路由命名空间
	 */
	public function setNamespace( string $namespace )
	{
		$this->namespace = $namespace;
	}

	/**
	 * 获得命名空间
	 */
	public function getNamespace()
	{
		$namespace = trim($this->namespace, '\\');
		if( $namespace )
			return '\\'.$namespace;
		else
			return '';
	}

	/**
	 * 设置命名空间
	 * @param string $prefix 路由命名空间
	 */
	public function setCallback( $callback )
	{
		$this->callback = $callback;
	}

	/**
	 * 获得命名空间
	 */
	public function getCallback()
	{
		return $this->callback;
	}

	/**
	 * 设置所有路由属性
	 * @param array $attributes 包含prefix和namespace
	 */
	public function setRouteAttributes( array $attributes )
	{
		$this->setPrefix( $attributes['prefix'] );
		$this->setNamespace( $attributes['namespace'] );
	}

	public function isGroup()
	{
		$this->isGroup = true;
	}

	public function addGroup( RouteModel $route )
	{
		$this->group[$route->getPrefix()] = $route;
	}

	public function getGroup()
	{
		return $this->group;
	}

}