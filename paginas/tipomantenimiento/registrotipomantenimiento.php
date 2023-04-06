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

		$nombretipomantenimiento = strtoupper($_POST['nombretipomantenimiento']);
		$nombretipomantenimiento2=lista($nombretipomantenimiento);

		$encontrado2='NO';
		if($nombretipomantenimiento2 == 'SI'){
			$encontrado2='SI';
		}

		if($encontrado2 == 'SI'){
			$alert='<p class="msg_error">No se permiten caracteres ni palabras especiales.</p>';
		}else{
			$query = mysqli_query($conection,"SELECT * FROM tipomantenimiento WHERE nombretipomantenimiento = '$nombretipomantenimiento' AND codcombustible = '$codcombustible'");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El Tipo de Mantenimiento ya existe.</p>';
			}else{

				while(1 > 0){

					$codigo = rand(10000,2000000000);
					$result2 = mysqli_query($conection,"SELECT idtipomantenimiento FROM tipomantenimiento where idtipomantenimiento = '$codigo' AND codcombustible = '$codcombustible'");
						
							$total = mysqli_fetch_array($result2);
							
							if ($total == 0) {
									break;
								}
				
					}
					$token = md5($codigo);

				$query_insert = mysqli_query($conection,"INSERT INTO tipomantenimiento(idtipomantenimiento,token,nombretipomantenimiento,codcombustible) 
														VALUES('$codigo','$token','$nombretipomantenimiento','$codcombustible')");
				
				date_default_timezone_set('America/Lima');
      			$fecham = date("Y-m-d H:i:s");
	  			$query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Tipo de Mantenimiento','$usuarionombre','$fecham','Registro','$nombretipomantenimiento','$codcombustible')");

				if($query_insert){
					$alert='<p class="msg_save">Tipo de Mantenimiento creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el Tipo de Mantenimiento.</p>';
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>tipomantenimiento</title>

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

<section id="container">
	<div class="margen">
	<div class="form_register">
			<h1>Registro de tipomantenimiento</h1>
			<a href="listartipomantenimiento.php" class="btn_new">Regresar</a>

			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="nombres">Tipo Mantenimiento</label>
				<input type="text" name="nombretipomantenimiento" id="nombretipomantenimiento" placeholder="Tipo Mantenimiento" style="text-transform:uppercase" class="tamano02" required>			

				<input type="submit" value="Crear Tipo Mantenimiento" class="btn_save">

			</form>


	</div>
	</div>
</section>

</body>
</html>
