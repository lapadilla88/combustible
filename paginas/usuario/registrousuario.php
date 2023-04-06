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
		
		$nombre = $_POST['nombre'];
		$nombre2=lista(strtoupper($nombre));

		$usuario = $_POST['usuario'];
		$usuario2=lista(strtoupper($usuario));

		$clave = md5($_POST['clave']);
		$clave2=lista(strtoupper($_POST['clave']));

		$tipo = $_POST['tipo'];


		$ingusuario = $_POST['ingusuario'];
		$ingcontrasena = $_POST['ingcontrasena'];
		$ingregistro = $_POST['ingregistro'];
		$ingvehiculo = $_POST['ingvehiculo'];
		$ingconductor = $_POST['ingconductor'];
		$inggrifo = $_POST['inggrifo'];
		$ingcombustible = $_POST['ingcombustible'];
		$ingtipomantenimiento = $_POST['ingtipomantenimiento'];
		$ingvalescombustible = $_POST['ingvalescombustible'];
		$ingmantenimientos = $_POST['ingmantenimientos'];
		$repvales = $_POST['repvales'];
		$repvalesvehiculo = $_POST['repvalesvehiculo'];
		$repmantenimiento = $_POST['repmantenimiento'];
		$repmantenimientovehiculo = $_POST['repmantenimientovehiculo'];

		$encontrado2='NO';
		if($nombre2 == 'SI'){
			$encontrado2='SI';
		}
		if($usuario2 == 'SI'){
			$encontrado2='SI';
		}
		if($clave2 == 'SI'){
			$encontrado2='SI';
		}

		if($encontrado2 == 'SI'){
			$alert='<p class="msg_error">No se permiten caracteres ni palabras especiales.</p>';
		}else{
			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE (nombre = '$nombre' OR usuario = '$usuario') AND codcombustible = '$codcombustible'");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El Nombre o el Usuario ya existe.</p>';
			}else{
				while(1 > 0){

					$codigo = rand(10000,2000000000);
					$result2 = mysqli_query($conection,"SELECT idusuario FROM usuario where idusuario = '$codigo' AND codcombustible = '$codcombustible'");
						
							$total = mysqli_fetch_array($result2);
							
							if ($total == 0) {
									break;
								}
				
					}
					$token = md5($codigo);

				$query_insert = mysqli_query($conection,"INSERT INTO usuario(idusuario,token,nombre,usuario,clave,tipo,ingusuario,ingcontrasena,ingregistro,ingvehiculo,ingconductor,inggrifo,ingcombustible,ingtipomantenimiento,ingvalescombustible,ingmantenimientos,repvales,repvalesvehiculo,repmantenimiento,repmantenimientovehiculo,codcombustible) 
														VALUES('$codigo','$token','$nombre','$usuario','$clave','$tipo','$ingusuario','$ingcontrasena','$ingregistro','$ingvehiculo','$ingconductor','$inggrifo','$ingcombustible','$ingtipomantenimiento','$ingvalescombustible','$ingmantenimientos','$repvales','$repvalesvehiculo','$repmantenimiento','$repmantenimientovehiculo','$codcombustible')");

				date_default_timezone_set('America/Lima');
				$fecham = date("Y-m-d H:i:s");
				$query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Usuarios','$usuarionombre','$fecham','Registro','$usuario','$codcombustible')");				

				if($query_insert){
					$alert='<p class="msg_save">Usuario creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el usuario.</p>';
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
  <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<section id="container">
	<div class="margen">
	<div class="form_register">
			<h1>Registro usuario</h1>
			<a href="listarusuario.php" class="btn_new">Regresar</a>

			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" required>
				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario" required>
				<label for="clave">Contraseña</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso" required>
				<label for="rol">Tipo Usuario</label>
        		<select name="tipo" id="tipo" required>
          			<option value="">(Seleccionar)</option>
          			<option value="Administrador">Administrador</option>
          			<option value="Usuario">Usuario</option>
        		</select>
				<label for="permisos">Permisos</label><br>

				<label for="permisos">Igresos</label><br>
				<input type="checkbox" name="ingvehiculo" class="radio01"> Vehiculos&nbsp;
				<input type="checkbox" name="ingconductor" class="radio01"> Conductores&nbsp;
				<input type="checkbox" name="ingcombustible" class="radio01"> Combustibles&nbsp;
				<input type="checkbox" name="inggrifo" class="radio01"> Grifos&nbsp;
				<input type="checkbox" name="ingtipomantenimiento" class="radio01"> T. Mantenimientos&nbsp;

				<br><label for="permisos">Registros</label><br>
				<input type="checkbox" name="ingvalescombustible" class="radio01"> Vales de Combustible&nbsp;
				<input type="checkbox" name="ingmantenimientos" class="radio01"> Mantenimientos&nbsp;

				<br><label for="permisos">Reportes</label><br>
				<input type="checkbox" name="repvales" class="radio01"> Reporte de Vales&nbsp;
				<input type="checkbox" name="repvalesvehiculo" class="radio01"> R. Vales por Vehículo&nbsp;
				<input type="checkbox" name="repmantenimiento" class="radio01"> Reporte Mantenimiento&nbsp;
				<input type="checkbox" name="repmantenimientovehiculo" class="radio01"> R. Manteni. Vehículo&nbsp;

				<br><label for="permisos">Configuración</label><br>
				<input type="checkbox" name="ingusuario" class="radio01"> Usuarios&nbsp;
				<input type="checkbox" name="ingcontrasena" class="radio01"> Cambiar Contraseña&nbsp;
				<input type="checkbox" name="ingregistro" class="radio01"> Eventos&nbsp;

				<input type="submit" value="Crear usuario" class="btn_save">

			</form>


	</div>
	</div>
</section>

</body>
</html>
