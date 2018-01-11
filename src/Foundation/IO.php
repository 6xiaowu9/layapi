<?php 
namespace LayAPI\Foundation;
/**
* 输出类
*/
class IO
{
	public function output( $data ){
		echo json_encode($data);
	}
}