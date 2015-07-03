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

(new Twig_Loader_Filesystem(TEMPLATEDIR));
// $twig = new Twig_Environment($loader);

// (new Campus())->hasUsuario(1);

// $Usuario = new Usuario();

// var_dump($Usuario->hasUsuario('joao_feck'));

// var_dump($Usuario->updateCampus(2));

// $login = "guilherme_flores";
// $nome = "Guilherme Oliveira Flores";
// $pass = "54321$$";

// $Usuario->setTxLogin($login);
// $Usuario->setTxNome($nome);
// $Usuario->setMd5Password($pass);

foreach (glob(ROOT . 'app' . DS . 'view' . DS . '*.php') as $filename) {
    require_once $filename;
}


$parameters = explode('/', $_GET['op']);

echo "<pre>";
var_dump($parameters);
echo "</pre>";

if (sizeof($parameters) > 4) {
	echo "maior que 4";
} else {

	$url = Util::isEmpty($parameters['0']) . "/" . Util::isEmpty($parameters['1']) . "/" . Util::isEmpty($parameters['2']) . "/";
	$id = Util::isEmpty($parameters['3']);

	var_dump($url);

	switch ($url) {
		case "admin/usuario/novo/": insertUsuario(); break;
		case "admin/usuario/editar/": updateUsuario($id); break;
		case "admin/usuario/excluir/": deteleUsuario($id); break;
		
		// case "admin/campus/novo/": insertCampus(); break;
		// case "admin/campus/editar/": updateCampus($id); break;
		// case "admin/campus/excluir/": deteleCampus($id); break;

		default: echo "URL não encontrada"; break;
	}
}


// $return = $Usuario->updateCampus(2);

// $return = $Usuario->deleteCampus(2);

echo $twig->render('login.html', array('baseUrl' => Util::baseUrl()));




