<?php
	session_start();
  	$varsesion = $_SESSION["id_usuario"];
	$codcombustible = $_SESSION["codcombustible"];
	$usuarionombre = $_SESSION['idnombre'];
	$tipousuario = $_SESSION['idtipo'];	
	
	if($varsesion == null || $varsesion = '') {
		echo 'Usted no tiene Autorización';
		// header("Location: bienvenidos.php");
		die();
  }
  
  include "../../conexion.php";

	if(!empty($_POST))
	{

		$token = $_POST['token'];
		$rucgrifo = $_POST['rucgrifo'];

		$query_delete = mysqli_query($conection,"DELETE FROM grifo WHERE token ='$token' AND codcombustible = '$codcombustible'");
		//$query_delete = mysqli_query($conection,"UPDATE grifo SET estatus = 0 WHERE idgrifo = $idgrifo ");
		date_default_timezone_set('America/Lima');
        $fecham = date("Y-m-d H:i:s");
        $query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Grifo','$usuarionombre','$fecham','Eliminar','$rucgrifo','$codcombustible')");

		mysqli_close($conection);
		if($query_delete){
			header("location: listargrifo.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['token']))
	{
		header("location: listargrifo.php");
		mysqli_close($conection);
	}else{

		$token = $_REQUEST['token'];

		$query = mysqli_query($conection,"SELECT * FROM grifo WHERE token = '$token' AND codcombustible = '$codcombustible'");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$rucgrifo = $data['rucgrifo'];
				$nombregrifo = $data['nombregrifo'];
			}
		}else{
			header("location: listargrifo.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>grifo</title>

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
  		<?php
		if($tipousuario == 'Administrador'){?>
			<div class="data_delete">
				<h2>¿Está seguro de eliminar el siguiente registro?</h2>
				<p><FONT COLOR="black">Ruc: </FONT><span><?php echo $rucgrifo; ?></span></p>
				<p><FONT COLOR="black">Razón Social: </FONT><span><?php echo $nombregrifo; ?></span></p>

				<form method="post" action="">
					<input type="hidden" name="token" value="<?php echo $token; ?>">
					<input type="hidden" name="rucgrifo" value="<?php echo $rucgrifo; ?>">
					<a href="listargrifo.php" class="btn_cancel">Cancelar</a>
					<input type="submit" value="Aceptar" class="btn_ok">
				</form>
			</div>
		<?php }else{ ?>
			<div class="data_delete">
				<h2>¡No tiene los privilegios para eliminar este registro!</h2>
				<p><FONT COLOR="black">Ruc: </FONT><span><?php echo $rucgrifo; ?></span></p>
				<p><FONT COLOR="black">Razón Social: </FONT><span><?php echo $nombregrifo; ?></span></p>

				<form method="post" action="">
					<input type="hidden" name="token" value="<?php echo $token; ?>">
					<input type="hidden" name="rucgrifo" value="<?php echo $rucgrifo; ?>">
					<a href="listargrifo.php" class="btn_cancel">Aceptar</a>
				</form>
			</div>
		<?php } ?>


	</section>




</body>

</html>
