<?php 
namespace LayAPI\Foundation;

use LayAPI\Http\Routing;
/**
* 启动类
*/
class Application
{
	public $neo = "xiaowu";
	public $route;
	function __construct()
	{
		$this->start();
	}

	protected function start()
	{
		Routing::start();
	}
}