<?php

use \Twig_Environment as Twig;
use \Twig_Loader_Filesystem as TwigLoader;

class Util extends Twig
{
	public static $instance;

	public function __construct() {
        self::$instance = $this;
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

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

	}

}