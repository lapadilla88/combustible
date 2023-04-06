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

		$placa = strtoupper($_POST['placa']);
		$placa2=lista($placa);

		$tipo = strtoupper($_POST['tipo']);
		$tipo2=lista($tipo);

		$anofabricacion = $_POST['anofabricacion'];

		$marca = strtoupper($_POST['marca']);
		$marca2=lista($marca);

		$idcombustible = $_POST['idcombustible'];
		
		$encontrado2='NO';
		if($placa2 == 'SI'){
			$encontrado2='SI';
		}
		if($tipo2 == 'SI'){
			$encontrado2='SI';
		}
		if($marca2 == 'SI'){
			$encontrado2='SI';
		}

		if($encontrado2 == 'SI'){
			$alert='<p class="msg_error">No se permiten caracteres ni palabras especiales.</p>';
		}else{
			$query = mysqli_query($conection,"SELECT * FROM vehiculo WHERE placa = '$placa' AND codcombustible = '$codcombustible'");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">La Placa ya existe.</p>';
			}else{
				while(1 > 0){

					$codigo = rand(10000,2000000000);
					$result2 = mysqli_query($conection,"SELECT idvehiculo FROM vehiculo where idvehiculo = '$codigo' AND codcombustible = '$codcombustible'");
						
							$total = mysqli_fetch_array($result2);
							
							if ($total == 0) {
									break;
								}
				
					}
					$token = md5($codigo);

				$query_insert = mysqli_query($conection,"INSERT INTO vehiculo(idvehiculo,token,placa,tipo,anofabricacion,marca,idcombustible,codcombustible) 
														VALUES('$codigo','$token','$placa','$tipo',$anofabricacion,'$marca',$idcombustible,'$codcombustible')");
				
				date_default_timezone_set('America/Lima');
				$fecham = date("Y-m-d H:i:s");
				$query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Vehiculo','$usuarionombre','$fecham','Registro','$placa','$codcombustible')");

				if($query_insert){
					$alert='<p class="msg_save">Vehiculo creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el Vehiculo.</p>';
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
  <link rel="stylesheet" type="text/css" href="../select2/select2.min.css">
  <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js" 
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script src="../select2/select2.min.js"></script>

</head>
<body>

<section id="container">
	<div class="margen">
	<div class="form_register">
			<h1>Registro de Vehículos</h1>
			<a href="listarvehiculo.php" class="btn_new">Regresar</a>

			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="placa">Placa</label>
				<input type="text" name="placa" id="placa" placeholder="Placa" style="text-transform:uppercase" class="tamano05" required>
				<label for="tipo">Tipo</label>
				<input type="text" name="tipo" id="tipo" placeholder="Tipo" style="text-transform:uppercase" required>
				<label for="fabricacion">Año de Fabricacion</label>
				<input type="number" name="anofabricacion" id="anofabricacion" placeholder="Año de Fabricacion" class="tamano05" required>
				<label for="clave">Marca</label>
				<input type="text" name="marca" id="marca" style="text-transform:uppercase" placeholder="Marca" required>
				<label for="rol">Combustible</label><br>
        		<?php 

					$query_rol = mysqli_query($conection,"SELECT * FROM combustible WHERE codcombustible = '$codcombustible'");
					$result_rol = mysqli_num_rows($query_rol);

				 ?>

				<select name="idcombustible" id="idcombustible" placeholder="Combustible" class="tamano04" required>
       			 <option value="">(Seleccionar)</option>
					<?php 
						if($result_rol > 0)
						{
							while ($rol = mysqli_fetch_array($query_rol)) {
					?>
							<option value="<?php echo $rol['idcombustible']; ?>"><?php echo $rol['nombrecombustible'] ?></option>
					<?php 
								# code...
							}
							
						}
					 ?>
        		</select>

				<script type="text/javascript">
	        		$(document).ready(function(){
			      	$('#idcombustible').select2();
          			});
				</script>


				<input type="submit" value="Crear Vehiculo" class="btn_save">

			</form>


	</div>
	</div>
</section>

</body>
</html>
