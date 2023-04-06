<?PHP

//$host = "localhost"; 	TU HOST//
//$dbuser = "incominf_usuario004";	 	//TU USUARIO DEL HOST//
//$dbpwd = "4f,mmM?2)Dy}";	//TU CONTRASE�A//
//$db = "incominf_combustible";		//TU BASE DE DATOS//

//$connect = mysql_connect ($host, $dbuser, $dbpwd);//
//if(!connect)//
//echo ("No se pudo conectar a la base de datos");//
//else//
//$select = mysql_select_db($db);//



//servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	$mysqli=new mysqli('localhost','root','123456','basededatos'); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>