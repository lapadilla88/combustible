<?php
	session_start();
  	$varsesion = $_SESSION["id_usuario"];
	$usuarionombre = $_SESSION['idnombre'];
	$codcombustible = $_SESSION["codcombustible"];
	
	if($varsesion == null || $varsesion = '') {
		echo 'Usted no tiene Autorización';
		// header("Location: bienvenidos.php");
		die();
  }
  
  include "../../conexion.php";

	if(!empty($_POST))
	{

		$token = $_POST['token'];
		$usuario = $_POST['usuario'];

		$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE token ='$token' AND codcombustible = '$codcombustible'");
		//$query_delete = mysqli_query($conection,"UPDATE usuario SET estatus = 0 WHERE idusuario = $idusuario ");

		date_default_timezone_set('America/Lima');
		$fecham = date("Y-m-d H:i:s");
		$query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Usuarios','$usuarionombre','$fecham','Eliminar','$usuario','$codcombustible')");

		mysqli_close($conection);
		if($query_delete){
			header("location: listarusuario.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['token']))
	{
		header("location: listarusuario.php");
		mysqli_close($conection);
	}else{

		$token = $_REQUEST['token'];

		$query = mysqli_query($conection,"SELECT * FROM usuario WHERE token = '$token' AND codcombustible = '$codcombustible'");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$nombre = $data['nombre'];
				$usuario = $data['usuario'];
				$tipo = $data['tipo'];
			}
		}else{
			header("location: listarusuario.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuario</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link href="../css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>  

  <!--==========================
  Contenido
  ============================-->
  <section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p><FONT COLOR="black">Nombre: </FONT><span><?php echo $nombre; ?></span></p>
			<p><FONT COLOR="black">usuario: </FONT><span><?php echo $usuario; ?></span></p>
			<p><FONT COLOR="black">Tipo: </FONT><span><?php echo $tipo; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="token" value="<?php echo $token; ?>">
				<input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
				<a href="listarusuario.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>




</body>

</html>
