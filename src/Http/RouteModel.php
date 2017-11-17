<?php 
namespace LayAPI\Http;

/**
* 路由模型类
*/
class RouteModel
{
	// 前缀
	private $prefix;

	// 命名空间
	private $namespace;

	// 执行方法
	private $callback;

	// 是否是路由组
	private $isGroup = false;

	// 路由组
	private $group;

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
		return $this->prefix;
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
		return $this->namespace;
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
	public function setRouteProperty( array $attributes )
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
		$this->group = $route;
	}
}