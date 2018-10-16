<?php 

require	'environment.php';

$config = array(); //criando array com os valores do banco de dados

if(ENVIRONMENT == 'development'){
	//caso o projeto seja local
	define("BASE_URL", "http://localhost/www/PHP_ZP/BACK/classificados_mvc/"); // url padrão
	$config['dbname'] = 'projeto_classificados'; //nome do banco 
	$config['host'] = 'localhost'; // nome da hospedagem
	$config['dbuser'] = 'root'; // nome de usuario de acesso a hospedagem
	$config['dbpass'] = 'root'; // senha de usuario de acesso as config de hospedagem
} else {
	//caso o projeto esteja online
	define("BASE_URL", "http://localhost/www/PHP_ZP/BACK/classificados_mvc/");
	$config['dbname'] = 'projeto_classificados';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
}

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);	
} catch (PDOException $e) {
	echo "ERRO:".$e->getMessage();
}



?>