<?php 

namespace LayAPI\Http;

interface RoutePropertyInterface
{
	public function prefix( $prefix );
	public function namespace();
}