<?php
namespace LayAPI\Http;

/**
* 响应类
*/
class Response
{
	public function json( $data )
	{
		// dump(func_get_args());exit;
		return Response::format( $data );
	}

	public function format( $data = '', $code = 200, $message = null )
	{
		return array(
			'code' => $code,
			'data' => $data,
			'message' => $message,
		);
	}

} 