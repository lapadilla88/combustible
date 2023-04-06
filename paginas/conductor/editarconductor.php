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
      
			$query = mysqli_query($conection,"SELECT * FROM conductor WHERE dni = '$dni' AND token != '$token' AND codcombustible = '$codcombustible'");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El dni ya existe.</p>';
			}else{
				$sql_update = mysqli_query($conection,"UPDATE conductor SET nombreconductor = '$nombreconductor', dni='$dni', licencia='$licencia', categoria='$categoria', telefonoconductor='$telefonoconductor' 
														WHERE token= '$token' AND codcombustible = '$codcombustible'");
				
				date_default_timezone_set('America/Lima');
				$fecham = date("Y-m-d H:i:s");
				$query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Conductor','$usuarionombre','$fecham','Modificar','$dni','$codcombustible')");

				if($sql_update){
					header('Location: listarconductor.php');
				}else{
					$alert='<p class="msg_error">Error al actualizar el conductor.</p>';
				}				  
        	}
		}

	}

  //Mostrar Datos
	if(empty($_REQUEST['token']))
	{
		header('Location: listarconductor.php');
		mysqli_close($conection);
	}
	$token = $_REQUEST['token'];

	$sql= mysqli_query($conection,"SELECT * FROM conductor WHERE token= '$token' AND codcombustible = '$codcombustible'");
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: listarconductor.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
		$nombreconductor  = $data['nombreconductor'];
		$dni = $data['dni'];
		$licencia= $data['licencia'];
		$categoria = $data['categoria'];
		$telefonoconductor = $data['telefonoconductor'];
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
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vehículo</title>

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
				<h1>Editar Conductor</h1>
				<a href="listarconductor.php" class="btn_new">Regresar</a>
				<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
				
				<form action="" method="post">
					<input type="hidden" name="token" required value="<?php echo $token; ?>">
					<label for="nombres">Nombres</label>
					<input type="text" name="nombreconductor" id="nombreconductor" placeholder="Nombres" style="text-transform:uppercase" class="tamano02" required value="<?php echo $nombreconductor; ?>">
					<label for="dni">CI</label>
					<input type="number" name="dni" id="dni" placeholder="Dni" class="tamano04" required value="<?php echo $dni; ?>">
					<label for="licencia">N° Licencia</label>
					<input type="text" name="licencia" id="licencia" placeholder="Licencia" style="text-transform:uppercase"class="tamano04" required value="<?php echo $licencia; ?>">
					<label for="categoria">Categoria</label>
					<input type="text" name="categoria" id="categoria" placeholder="Cateoria" style="text-transform:uppercase" class="tamano04" value="<?php echo $categoria; ?>">
					<label for="telefono">Teléfono</label>
					<input type="text" name="telefonoconductor" id="telefonoconductor" placeholder="Teléfono" style="text-transform:uppercase" class="tamano03" value="<?php echo $telefonoconductor; ?>">				

				<input type="submit" value="Actualizar Conductor" class="btn_save">

			</form>
			</div>
      	</div>
	</section>





</body>

</html>
