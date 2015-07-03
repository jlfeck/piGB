<?php

function insertUsuario()
{
	// $Usuario = new UsuarioController();
	// echo "inserir";

	// $Usuario

	// echo $twig->render('panel.html', array('baseUrl' => Util::baseUrl()));

	$app = Util::getInstance();

	echo $app->render('panel.html');
}

function updateUsuario($id = null)
{
	print_r($id);
}

function deteleUsuario($id = null)
{
	print_r($id);
}