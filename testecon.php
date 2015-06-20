<?php

$banco = "a7663294_pigb";
$usuario = "a7663294_pigb";
$senha = "pigr4ub3";
$hostname = "mysql13.000webhost.com";
$conn = mysqli_connect($hostname,$banco,$usuario,$senha);
if (!$conn) {echo "Não foi possível conectar ao banco MySQL.
"; exit;}
else {echo "Parabéns!! A conexão ao banco de dados ocorreu normalmente!.
";}
mysqli_close();