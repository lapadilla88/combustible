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
		$alert='';
    
		$token = $_POST['token'];
		$nombregrifo = strtoupper($_POST['nombregrifo']);
		$nombregrifo2=lista($nombregrifo);

		$rucgrifo = $_POST['rucgrifo'];

		$direcciongrifo = strtoupper($_POST['direcciongrifo']);
		$direcciongrifo2=lista($direcciongrifo);

		$telefonogrifo = strtoupper($_POST['telefonogrifo']);
		$telefonogrifo2=lista($telefonogrifo);

		$encontrado2='NO';
		if($nombregrifo2 == 'SI'){
			$encontrado2='SI';
		}
		if($direcciongrifo2 == 'SI'){
			$encontrado2='SI';
		}
		if($telefonogrifo2 == 'SI'){
			$encontrado2='SI';
		}

		if($encontrado2 == 'SI'){
			$alert='<p class="msg_error">No se permiten caracteres ni palabras especiales.</p>';
		}else{      
			$query = mysqli_query($conection,"SELECT * FROM grifo WHERE rucgrifo = '$rucgrifo' AND token != '$token' AND codcombustible = '$codcombustible'");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El ruc ya existe.</p>';
			}else{
				$sql_update = mysqli_query($conection,"UPDATE grifo SET nombregrifo = '$nombregrifo', rucgrifo='$rucgrifo', direcciongrifo='$direcciongrifo', telefonogrifo='$telefonogrifo' 
														WHERE token= '$token' AND codcombustible = '$codcombustible'");
				
				date_default_timezone_set('America/Lima');
				$fecham = date("Y-m-d H:i:s");
				$query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Grifo','$usuarionombre','$fecham','Modificar','$rucgrifo','$codcombustible')");

				if($sql_update){
					header('Location: listargrifo.php');
				}else{
					$alert='<p class="msg_error">Error al actualizar el Grifo.</p>';
				}
				  
        	}
		}
	}

	function lista($valor){
		$archivo = file('../lista.txt');
		$encontrado=0;
		foreach($archivo as $linea){
			if(strpos($valor,trim($linea))!==false){
				$encontrado = 1;
				break;
			}
		}		
		if($encontrado == 1){
			return "SI";
		}
	}

 	//Mostrar Datos
	if(empty($_REQUEST['token']))
	{
		header('Location: listargrifo.php');
		mysqli_close($conection);
	}
	$token = $_REQUEST['token'];

	$sql= mysqli_query($conection,"SELECT * FROM grifo WHERE token= '$token' AND codcombustible = '$codcombustible'");
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: listargrifo.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
	  $nombregrifo  = $data['nombregrifo'];
      $rucgrifo = $data['rucgrifo'];
      $direcciongrifo = $data['direcciongrifo'];
      $telefonogrifo = $data['telefonogrifo'];

		}
	}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Grifo</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link href="../css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/select2.css">
  <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="../js/jquery-3.1.1.min.js"></script>
  <script src="../js/select2.js"></script>

</head>

<body>  

  <!--==========================
  Contenido
  ============================-->
  	<section id="container">
		<div class="margen">
			<div class="form_register">
				<h1>Editar Grifo</h1>
				<a href="listargrifo.php" class="btn_new">Regresar</a>
				<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
				
				<form action="" method="post">
					<input type="hidden" name="token" required value="<?php echo $token; ?>">
					<label for="nombres">Razón Social</label>
					<input type="text" name="nombregrifo" id="nombregrifo" placeholder="Razón Social" style="text-transform:uppercase" class="tamano02" required value="<?php echo $nombregrifo; ?>">
					<label for="ruc">Ruc</label>
					<input type="number" name="rucgrifo" id="rucgrifo" placeholder="Ruc" class="tamano04" required value="<?php echo $rucgrifo; ?>">
					<label for="categoria">Dirección</label>
					<input type="text" name="direcciongrifo" id="direcciongrifo" placeholder="Dirección" style="text-transform:uppercase" class="tamano02" value="<?php echo $direcciongrifo; ?>">
					<label for="telefono">Teléfono</label>
					<input type="text" name="telefonogrifo" id="telefonogrifo" placeholder="Teléfono" style="text-transform:uppercase" class="tamano03" value="<?php echo $telefonogrifo; ?>">				

				<input type="submit" value="Actualizar Grifo" class="btn_save">

			</form>
			</div>
      	</div>
	</section>





</body>

</html>
