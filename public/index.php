<?php
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
$twig = new Twig_Environment($loader, array(
    'cache' => CACHETEMPLATEDIR,
));


$arrayName = array('name' => 'joao', 
					'idade' => '21');

echo $twig->render('index.html', $arrayName);