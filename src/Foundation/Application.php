<?php 
namespace Neo\Foundation;

use Neo\Http\Route;
/**
* 启动类
*/
class Application
{
	public $neo = "xiaowu";
	public $route;
	function __construct()
	{
		$this->$app = new Route();
	}
}