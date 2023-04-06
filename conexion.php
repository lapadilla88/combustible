<?php 
	
	$host = 'localhost';
	$user = 'root';
	$password = '123456';
	$db = 'basededatos';

	$conection = @mysqli_connect($host,$user,$password,$db);

	if(!$conection){
		echo "Error en la conexión";
	}

?>