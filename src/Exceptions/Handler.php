<?php 

namespace LayAPI\Exceptions;

/**
* 异常处理类
*/
class Handler extends Exception
{
	
	public function __construct($message, $code = 0) { 
		// 自定义的代码 
		// 确保所有变量都被正确赋值 
		parent::__construct($message, $code); 
	} 
}