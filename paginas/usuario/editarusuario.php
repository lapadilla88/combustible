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
      $query = mysqli_query($conection,"SELECT * FROM usuario WHERE (nombre = '$nombre' OR usuario = '$usuario') AND token != '$token' AND codcombustible = '$codcombustible'");
      $result = mysqli_fetch_array($query);

      if($result > 0){
        $alert='<p class="msg_error">El Usuario ya existe.</p>';
      }else{
        if(empty($_POST['clave']))
				{
          $sql_update = mysqli_query($conection,"UPDATE usuario SET nombre = '$nombre', usuario='$usuario', tipo='$tipo', ingusuario='$ingusuario', ingcontrasena='$ingcontrasena', ingregistro='$ingregistro', ingvehiculo='$ingvehiculo', ingconductor='$ingconductor', inggrifo='$inggrifo', ingcombustible='$ingcombustible', ingtipomantenimiento='$ingtipomantenimiento', ingvalescombustible='$ingvalescombustible', ingmantenimientos='$ingmantenimientos', repvales='$repvales', repvalesvehiculo='$repvalesvehiculo', repmantenimiento='$repmantenimiento', repmantenimientovehiculo='$repmantenimientovehiculo'
                                                WHERE token= '$token' AND codcombustible = '$codcombustible'");
          if($sql_update){
            header('Location: listarusuario.php');
          }else{
            $alert='<p class="msg_error">Error al actualizar el Usuario.</p>';
          }
				}else{
					$sql_update = mysqli_query($conection,"UPDATE usuario SET nombre = '$nombre', usuario='$usuario', clave='$clave', tipo='$tipo', ingusuario='$ingusuario', ingcontrasena='$ingcontrasena', ingregistro='$ingregistro', ingvehiculo='$ingvehiculo', ingconductor='$ingconductor', inggrifo='$inggrifo', ingcombustible='$ingcombustible', ingtipomantenimiento='$ingtipomantenimiento', ingvalescombustible='$ingvalescombustible', ingmantenimientos='$ingmantenimientos', repvales='$repvales', repvalesvehiculo='$repvalesvehiculo', repmantenimiento='$repmantenimiento', repmantenimientovehiculo='$repmantenimientovehiculo'
                                                WHERE token= '$token'");
            
          if($sql_update){
            header('Location: listarusuario.php');
          }else{
            $alert='<p class="msg_error">Error al actualizar el Usuario.</p>';
          }
				  
        }
        date_default_timezone_set('America/Lima');
				$fecham = date("Y-m-d H:i:s");
				$query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Usuarios','$usuarionombre','$fecham','Modificar','$usuario','$codcombustible')");	

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
		header('Location: listarusuario.php');
		mysqli_close($conection);
	}
	$token = $_REQUEST['token'];

	$sql= mysqli_query($conection,"SELECT * FROM usuario WHERE token= '$token'");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: listarusuario.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...

			$nombre  = $data['nombre'];
      $usuario = $data['usuario'];
      $tipo = $data['tipo'];
      $ingusuario = $data['ingusuario'];
      $ingcontrasena= $data['ingcontrasena'];
      $ingregistro= $data['ingregistro'];
      $ingvehiculo = $data['ingvehiculo'];
      $ingconductor = $data['ingconductor'];
      $inggrifo = $data['inggrifo'];
  		$ingcombustible = $data['ingcombustible'];
  		$ingtipomantenimiento = $data['ingtipomantenimiento'];
      $ingvalescombustible = $data['ingvalescombustible'];
      $ingmantenimientos = $data['ingmantenimientos'];
      $repvales = $data['repvales'];
      $repvalesvehiculo = $data['repvalesvehiculo'];
      $repmantenimiento = $data['repmantenimiento'];
      $repmantenimientovehiculo = $data['repmantenimientovehiculo'];

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
	  <div class="margen">
	  <div class="form_register">
			<h1>Editar Usuario</h1>
			<a href="listarusuario.php" class="btn_new">Regresar</a>
      <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
      
      <form action="" method="post">
				<input type="hidden" name="token" required value="<?php echo $token; ?>">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" required value="<?php echo $nombre; ?>">
				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario" required value="<?php echo $usuario; ?>">
				<label for="clave">Contraseña</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso">
				<label for="rol">Tipo Usuario</label>
        <select name="tipo" id="tipo" required>
          <option value="<?php echo $tipo; ?>"><?php echo $tipo; ?></option>
          <option value="Administrador">Administrador</option>
          <option value="Usuario">Usuario</option>
        </select>
        <label for="permisos">Permisos</label><br>

        <label for="permisos">Ingresos</label><br>
        <?php if ($ingvehiculo == 'on'){ ?>
				  <input type="checkbox" name="ingvehiculo" class="radio01" checked> Vehículos&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="ingvehiculo" class="radio01"> Vehículos&nbsp;
        <?php } ?>

        <?php if ($ingconductor == 'on'){ ?>
				  <input type="checkbox" name="ingconductor" class="radio01" checked> Conductores&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="ingconductor" class="radio01"> Conductores&nbsp;
        <?php } ?>

        <?php if ($ingcombustible == 'on'){ ?>
				  <input type="checkbox" name="ingcombustible" class="radio01" checked> Combustible&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="ingcombustible" class="radio01"> Combustible&nbsp;
        <?php } ?>

        <?php if ($inggrifo == 'on'){ ?>
				  <input type="checkbox" name="inggrifo" class="radio01" checked> Grifos&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="inggrifo" class="radio01"> Grifos&nbsp;
        <?php } ?>

        <?php if ($ingtipomantenimiento == 'on'){ ?>
				  <input type="checkbox" name="ingtipomantenimiento" class="radio01" checked> T. Mantenimientos&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="ingtipomantenimiento" class="radio01"> T. Mantenimientos&nbsp;
        <?php } ?>

        <br><label for="permisos">Registros</label><br>
        <?php if ($ingvalescombustible == 'on'){ ?>
				  <input type="checkbox" name="ingvalescombustible" class="radio01" checked> Vales de Combustible&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="ingvalescombustible" class="radio01"> Vales de Combustible&nbsp;
        <?php } ?>

        <?php if ($ingmantenimientos == 'on'){ ?>
				  <input type="checkbox" name="ingmantenimientos" class="radio01" checked> Mantenimientos&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="ingmantenimientos" class="radio01"> Mantenimientos&nbsp;
        <?php } ?>

        <br><label for="permisos">Reportes</label><br>
        <?php if ($repvales == 'on'){ ?>
				  <input type="checkbox" name="repvales" class="radio01" checked> Reporte de Vales&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="repvales" class="radio01"> Reporte de Vales&nbsp;
        <?php } ?>

        <?php if ($repvalesvehiculo == 'on'){ ?>
				  <input type="checkbox" name="repvalesvehiculo" class="radio01" checked> R. Vales por Vehículo&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="repvalesvehiculo" class="radio01"> R. Vales por Vehículo&nbsp;
        <?php } ?>

        <?php if ($repmantenimiento == 'on'){ ?>
				  <input type="checkbox" name="repmantenimiento" class="radio01" checked> Reporte de Mantenimiento&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="repmantenimiento" class="radio01"> Reporte Mantenimiento&nbsp;
        <?php } ?>

        <?php if ($repmantenimientovehiculo == 'on'){ ?>
				  <input type="checkbox" name="repmantenimientovehiculo" class="radio01" checked> R. Manteni. Vehículo&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="repmantenimientovehiculo" class="radio01"> R. Manteni. Vehículoo&nbsp;
        <?php } ?>

        <br><label for="permisos">Configuración</label><br>

        <?php if ($ingusuario == 'on'){ ?>
				  <input type="checkbox" name="ingusuario" class="radio01" checked> Usuarios&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="ingusuario" class="radio01"> Usuarios&nbsp;
        <?php } ?>

        <?php if ($ingcontrasena == 'on'){ ?>
				  <input type="checkbox" name="ingcontrasena" class="radio01" checked> Cambiar Contrseña&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="ingcontrasena" class="radio01"> Cambiar Contrseña&nbsp;
        <?php } ?>

        <?php if ($ingregistro == 'on'){ ?>
				  <input type="checkbox" name="ingregistro" class="radio01" checked> Eventos&nbsp;
        <?php } else { ?>
          <input type="checkbox" name="ingregistro" class="radio01"> Eventos&nbsp;
        <?php } ?>

				
				<input type="submit" value="Actualizar Usuario" class="btn_save">

			</form>


		</div>
    </div>

	</section>





</body>

</html>
