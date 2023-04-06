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

		$nombreconductor = strtoupper($_POST['nombreconductor']);
		$nombreconductor2=lista($nombreconductor);

		$dni = $_POST['dni'];

		$licencia = strtoupper($_POST['licencia']);
		$licencia2=lista($licencia);

		$categoria = strtoupper($_POST['categoria']);
		$categoria2=lista($categoria);

		$telefonoconductor = $_POST['telefonoconductor'];
		$telefonoconductor2=lista($telefonoconductor);

		$encontrado2='NO';
		if($nombreconductor2 == 'SI'){
			$encontrado2='SI';
		}
		if($licencia2 == 'SI'){
			$encontrado2='SI';
		}
		if($categoria2 == 'SI'){
			$encontrado2='SI';
		}
		if($telefonoconductor2 == 'SI'){
			$encontrado2='SI';
		}

		if($encontrado2 == 'SI'){
			$alert='<p class="msg_error">No se permiten caracteres ni palabras especiales.</p>';
		}else{
			$query = mysqli_query($conection,"SELECT * FROM conductor WHERE dni = '$dni' AND codcombustible = '$codcombustible'");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El dni ya existe.</p>';
			}else{

				while(1 > 0){

					$codigo = rand(10000,2000000000);
					$result2 = mysqli_query($conection,"SELECT idconductor FROM conductor where idconductor = '$codigo' AND codcombustible = '$codcombustible'");
						
							$total = mysqli_fetch_array($result2);
							
							if ($total == 0) {
									break;
								}
				
					}
					$token = md5($codigo);

				$query_insert = mysqli_query($conection,"INSERT INTO conductor(idconductor,token,nombreconductor,dni,licencia,categoria,telefonoconductor,codcombustible) 
														VALUES('$codigo','$token','$nombreconductor','$dni','$licencia','$categoria','$telefonoconductor','$codcombustible')");
				
				date_default_timezone_set('America/Lima');
				$fecham = date("Y-m-d H:i:s");
				$query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Conductor','$usuarionombre','$fecham','Registro','$dni','$codcombustible')");

				if($query_insert){
					$alert='<p class="msg_save">Conductor creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el Conductor.</p>';
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
  <title>Usuario</title>

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
			<h1>Registro de Conductores</h1>
			<a href="listarconductor.php" class="btn_new">Regresar</a>

			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="nombres">Nombres</label>
				<input type="text" name="nombreconductor" id="nombreconductor" placeholder="Nombres" style="text-transform:uppercase" class="tamano02" required>
				<label for="dni">CI</label>
				<input type="number" name="dni" id="dni" placeholder="CI" class="tamano04" required>
				<label for="licencia">N° Licencia</label>
				<input type="text" name="licencia" id="licencia" placeholder="Licencia" style="text-transform:uppercase"class="tamano04" required>
				<label for="categoria">Categoria</label>
				<input type="text" name="categoria" id="categoria" placeholder="Cateoria" style="text-transform:uppercase" class="tamano04">
				<label for="telefono">Teléfono</label>
				<input type="text" name="telefonoconductor" id="telefonoconductor" placeholder="Teléfono" style="text-transform:uppercase" class="tamano03">				

				<input type="submit" value="Crear Conductor" class="btn_save">

			</form>


	</div>
	</div>
</section>

</body>
</html>
