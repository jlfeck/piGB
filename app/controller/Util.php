<?php

use \Twig_Environment as Twig;
use \Twig_Loader_Filesystem as TwigLoader;

class Util
{
	public static function baseUrl()
	{
		return sprintf(
		"%s://%s%s",
		isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
				$_SERVER['SERVER_NAME'],
				"/"
		);
	}

	public static function currentUrl()
	{
		return sprintf(
		"%s://%s%s",
		isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
				$_SERVER['SERVER_NAME'],
				$_SERVER['REQUEST_URI']
		);
	}

	public static function isEmpty($var = null)
	{
		return isset($var) ? $var : '';
	}

	public static function isPost()
	{ 
		return ($_SERVER['REQUEST_METHOD'] == 'POST');
	}

}