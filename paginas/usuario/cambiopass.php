<?php
    session_start();
    $varsesion = $_SESSION["id_usuario"];
    $idusuario = $_SESSION["ididusuario"];
    $usuarionombre = $_SESSION['idnombre'];
    $codcombustible = $_SESSION["codcombustible"];
    
    if($varsesion == null || $varsesion = '') {
      echo 'Usted no tiene Autorización';
      // header("Location: bienvenidos.php");
      die();
    }
  
  include "../../conexion.php";



  if(!empty($_POST)){

    $va1 = strtoupper($_POST['clave']);
    $var11=lista($va1);

    $encontrado2='NO';
    if($var11 == 'SI'){
      $encontrado2='SI';
    }

    if($encontrado2 == 'SI'){
      $alert='<p class="msg_error">No se permiten caracteres ni palabras especiales.</p>';
    }else{
      $clave = $_POST['clave'];
      
      $clave2 = md5($clave);

      $sql_update = mysqli_query($conection,"UPDATE usuario SET clave='$clave2'
                                            WHERE idusuario= $idusuario AND codcombustible = '$codcombustible'");
                                           //echo "UPDATE usuario SET clave='$clave2'WHERE idusuario= $idusuario AND codcombustible = '$codcombustible'";
      
      date_default_timezone_set('America/Lima');
      $fecham = date("Y-m-d H:i:s");
      $query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Usuarios','$usuarionombre','$fecham','Cambiar Usuario','$usuarionombre','$codcombustible')");	
        
      if($sql_update){
        $alert='<p class="msg_save">Se actualizo la Contraseña.</p>';
      }else{
        $alert='<p class="msg_error">Error al actualizar la Contraseña.</p>';
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
</head>

<body>  

  <!--==========================
  Contenido
  ============================-->
  <section id="container">
		
		<div class="form_register">
			<h1>Cambio de Contraseña</h1>
			<hr>
      <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
      
      <form action="" method="post">
				<label for="clave">Contraseña</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de acceso">

				<input type="submit" value="Actualizar Contraseña" class="btn_save">

			</form>


		</div>


	</section>





</body>

</html>
