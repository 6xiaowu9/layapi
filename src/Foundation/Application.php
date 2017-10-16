<?php 
namespace LayAPI\Foundation;

use LayAPI\Http\Route;
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