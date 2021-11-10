<?php
define('HOST','localhost');
define('DB','SEU BANCO');
define('USER','SEU USUARIO');
define('PASS','SUA SENHA');

$conexao = 'mysql:host='.HOST.';dbname='.DB;

try{
	$conecta = new PDO($conexao,USER,PASS);
	$conecta->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	
}catch (PDOexception $error_conecta){
   echo htmlentities('Erro ao conectar '.$error_conecta->getMessage());
}


?>
