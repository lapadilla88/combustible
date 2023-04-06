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
		$nombrecombustible = strtoupper($_POST['nombrecombustible']);
		$nombrecombustible2=lista($nombrecombustible);

		$encontrado2='NO';
		if($nombrecombustible2 == 'SI'){
			$encontrado2='SI';
		}

		if($encontrado2 == 'SI'){
			$alert='<p class="msg_error">No se permiten caracteres ni palabras especiales.</p>';
		}else{      
			$query = mysqli_query($conection,"SELECT * FROM combustible WHERE nombrecombustible = '$nombrecombustible' AND token != '$token' AND codcombustible = '$codcombustible'");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El Combustible ya existe.</p>';
			}else{
			$sql_update = mysqli_query($conection,"UPDATE combustible SET nombrecombustible = '$nombrecombustible' 
													WHERE token= '$token' AND codcombustible = '$codcombustible'");
			
			date_default_timezone_set('America/Lima');
			$fecham = date("Y-m-d H:i:s");
			$query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Combustible','$usuarionombre','$fecham','Modificar','$nombrecombustible','$codcombustible')");

			if($sql_update){
				header('Location: listarcombustible.php');
			}else{
				$alert='<p class="msg_error">Error al actualizar el Combustible.</p>';
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
		header('Location: listarcombustible.php');
		mysqli_close($conection);
	}
	$token = $_REQUEST['token'];

	$sql= mysqli_query($conection,"SELECT * FROM combustible WHERE token= '$token' AND codcombustible = '$codcombustible'");
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: listarcombustible.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
	  $nombrecombustible  = $data['nombrecombustible'];

		}
	}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Combustible</title>

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
				<h1>Editar Combustible</h1>
				<a href="listarcombustible.php" class="btn_new">Regresar</a>
				<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
				
				<form action="" method="post">
					<input type="hidden" name="token" required value="<?php echo $token; ?>">
					<label for="nombres">Nombre Combustible</label>
					<input type="text" name="nombrecombustible" id="nombrecombustible" placeholder="Nombre Combustible" style="text-transform:uppercase" class="tamano02" required value="<?php echo $nombrecombustible; ?>">				

				<input type="submit" value="Actualizar Combustible" class="btn_save">

			</form>
			</div>
      	</div>
	</section>





</body>

</html>
