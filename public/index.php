<?php

// include '../config/config.php';

/**
 * Define some constants
 */
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__DIR__)) . DS);
define("VENDORDIR", ROOT . "vendor" . DS);
define("TEMPLATEDIR", ROOT . "public/templates" . DS);
define("CACHETEMPLATEDIR", ROOT . "public/templates/cache" . DS);

/**
 * Include autoload file
 */
if (file_exists(VENDORDIR . "autoload.php")) {
    require_once VENDORDIR . "autoload.php";
} else {
    die("<pre>Execute '/c/xampp/php/php composer.phar install' na raiz do projeto</pre>");
}

$loader = new Twig_Loader_Filesystem(TEMPLATEDIR);
$twig = new Twig_Environment($loader);

function url(){
	return sprintf(
	"%s://%s%s",
	isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
			$_SERVER['SERVER_NAME'],
			$_SERVER['REQUEST_URI']
	);
}

$user = new User();

var_dump($user->hasUser('admin'));


$arrayName = array('baseUrl' => url(),
					'name' => 'joao', 
					'idade' => '24');

echo $twig->render('login.html', $arrayName);