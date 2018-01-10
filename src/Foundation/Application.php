<?php 
namespace LayAPI\Foundation;

use LayAPI\Http\Routing;
/**
* 启动类
*/
class Application
{
	function __construct()
	{
		$this->start();
	}

	protected function start()
	{
		Routing::start();
	}

	public function getClass(){
		return \LayAPI\Http\RouteModel::class;
	}
}