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
      	$numeromantenimiento = strtoupper($_POST['numeromantenimiento']);
		$numeromantenimiento2=lista($numeromantenimiento);

		$idvehiculo = $_POST['idvehiculo'];
		$idtipomantenimiento = $_POST['idtipomantenimiento'];
		$fechamantenimiento = $_POST['fechamantenimiento'];
		$fechapmantenimiento = $_POST['fechapmantenimiento'];

		$descripcion = strtoupper($_POST['descripcion']);
		$descripcion2=lista($descripcion);

		$kilometraje = $_POST['kilometraje'];
		$costo = $_POST['costo'];

		if($numeromantenimiento2 == 'SI'){
			$encontrado2='SI';
		}
		if($descripcion2 == 'SI'){
			$encontrado2='SI';
		}

		if($encontrado2 == 'SI'){
			$alert='<p class="msg_error">No se permiten caracteres ni palabras especiales.</p>';
		}else{      
			$query = mysqli_query($conection,"SELECT * FROM mantenimiento WHERE numeromantenimiento = '$numeromantenimiento' AND token != '$token' AND codcombustible = '$codcombustible'");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El N° de Mantenimiento ya existe.</p>';
			}else{
				$sql_update = mysqli_query($conection,"UPDATE mantenimiento SET numeromantenimiento='$numeromantenimiento', idvehiculo=$idvehiculo, idtipomantenimiento=$idtipomantenimiento, fechamantenimiento='$fechamantenimiento', fechapmantenimiento='$fechapmantenimiento',descripcion='$descripcion', kilometraje=$kilometraje, costo=$costo 
														WHERE token= '$token' AND codcombustible = '$codcombustible'");
				
				date_default_timezone_set('America/Lima');
				$fecham = date("Y-m-d H:i:s");
				$query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Mantenimento','$usuarionombre','$fecham','Modificar','$numeromantenimiento','$codcombustible')");

				if($sql_update){
					header('Location: listarmantenimiento.php');
				}else{
					$alert='<p class="msg_error">Error al actualizar el Mantenimiento.</p>';
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
		header('Location: listarmantenimiento.php');
		mysqli_close($conection);
	}
	$token = $_REQUEST['token'];

	$sql= mysqli_query($conection,"SELECT * FROM mantenimiento WHERE token= '$token' AND codcombustible = '$codcombustible'");
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: listarmantenimiento.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$numeromantenimiento = $data['numeromantenimiento'];
			$idvehiculo = $data['idvehiculo'];
			$idtipomantenimiento = $data['idtipomantenimiento'];
			$fechamantenimiento = $data['fechamantenimiento'];
			$fechapmantenimiento = $data['fechapmantenimiento'];
			$descripcion = $data['descripcion'];
			$kilometraje = $data['kilometraje'];
			$costo = $data['costo'];

		}
	}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mantenimientos</title>

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

  <!--==========================
  Contenido
  ============================-->
  <section id="container">
	  <div class="margen">
	  <div class="form_register">
			<h1>Editar Mantenimiento</h1>
			<a href="listarmantenimiento.php" class="btn_new">Regresar</a>
      <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

		<form action="" method="post" name="form1">
			<input type="hidden" name="token" required value="<?php echo $token; ?>">
			<label for="numeromantenimiento">N° Mantenimiento</label>
			<input type="text" name="numeromantenimiento" id="numeromantenimiento" placeholder="N° Mantenimiento" style="text-transform:uppercase" class="tamano04" required value="<?php echo $numeromantenimiento; ?>">
			<label for="rol">Vehículo</label><br>
			
			<?php 

				$query_rol = mysqli_query($conection,"SELECT * FROM vehiculo WHERE codcombustible = '$codcombustible'");
				$result_rol = mysqli_num_rows($query_rol);

				$query_rol2 = mysqli_query($conection,"SELECT * FROM vehiculo WHERE idvehiculo= $idvehiculo AND codcombustible = '$codcombustible'");
				$result_rol2 = mysqli_num_rows($query_rol2);          
				$rol2 = mysqli_fetch_array($query_rol2);

				?>

			<select name="idvehiculo" id="idvehiculo" placeholder="Vehículo" class="tamano03" required>
			<option value="<?php echo $rol2['idvehiculo']; ?>"><?php echo $rol2['placa'] . ' - ' . $rol2['tipo'] . ' - ' . $rol2['marca'];?></option>
				<option value="">(Seleccionar)</option>
				<?php 
					if($result_rol > 0)
					{
						while ($rol = mysqli_fetch_array($query_rol)) {
				?>
						<option value="<?php echo $rol['idvehiculo']; ?>"><?php echo $rol['placa'] . ' - ' . $rol['tipo'] . ' - ' . $rol['marca'];?></option>
				<?php 
							# code...
						}
						
					}
					?>
			</select>

			<script type="text/javascript">
				$(document).ready(function(){
				$('#idvehiculo').select2();
				});
			</script>

			<br><label for="rol">Tipo de Mantenimiento</label>
			
			<?php 

				$query_rol = mysqli_query($conection,"SELECT * FROM tipomantenimiento WHERE codcombustible = '$codcombustible'");
				$result_rol = mysqli_num_rows($query_rol);

				$query_rol2 = mysqli_query($conection,"SELECT * FROM tipomantenimiento WHERE idtipomantenimiento= $idtipomantenimiento AND codcombustible = '$codcombustible'");
				$result_rol2 = mysqli_num_rows($query_rol2);          
				$rol2 = mysqli_fetch_array($query_rol2);

				?>

			<br><select name="idtipomantenimiento" id="idtipomantenimiento" placeholder="Tipo de Mantenimiento" class="tamano02" required>
			<option value="<?php echo $rol2['idtipomantenimiento']; ?>"><?php echo $rol2['nombretipomantenimiento'];?></option>
				<option value="">(Seleccionar)</option>
				<?php 
					if($result_rol > 0)
					{
						while ($rol = mysqli_fetch_array($query_rol)) {
				?>
						<option value="<?php echo $rol['idtipomantenimiento']; ?>"><?php echo $rol['nombretipomantenimiento'];?></option>
				<?php 
							# code...
						}
						
					}
					?>
			</select>

			<script type="text/javascript">
				$(document).ready(function(){
				$('#idtipomantenimiento').select2();
				});
			</script>
			<br><label for="fecha">Fecha Mantenimiento</label>
			<input type="date" name="fechamantenimiento" id="fechamantenimiento" placeholder="Fecha Mantenimiento" required value="<?php echo $fechamantenimiento; ?>">
			<label for="fecha">Fecha Próxima</label>
			<input type="date" name="fechapmantenimiento" id="fechapmantenimiento" placeholder="Fecha Próxima" value="<?php echo $fechapmantenimiento; ?>">
			<label for="descripcion">Descripción</label>
			<textarea type="message" name="descripcion" id="descripcion" rows="2" style="text-transform:uppercase" class="tamano02" ><?php echo $descripcion; ?></textarea>
			<label for="kilometraje">Kilometraje</label>
			<input type="number" name="kilometraje" id="kilometraje" class="tamano05" onfocus="if(this.value == '0') {this.value=''}" onblur="if(this.value == ''){this.value ='0'}" required value="<?php echo $kilometraje; ?>">

			<script type="text/javascript">

			function redondea(sVal, nDec){
			var n = parseFloat(sVal);
			var s = "0.00";
			if (!isNaN(n)){
				n = Math.round(n * Math.pow(10, nDec)) / Math.pow(10, nDec);
				s = String(n);
				s += (s.indexOf(".") == -1? ".": "") + String(Math.pow(10, nDec)).substr(1);
				s = s.substr(0, s.indexOf(".") + nDec + 1);
			}
			return s;
			}
			
			function calcula(operacion, nDec, igvv){  
			document.form1.costo.value = redondea(document.form1.costo.value,nDec);

			}

			</script>

			<label for="costo">Costo</label>
			<input type="number" name="costo" id="costo" class="tamano05" step="0.01" onChange="calcula('+',2)" onfocus="if(this.value == '0.00') {this.value=''}" onblur="if(this.value == ''){this.value ='0.00'}" required value="<?php echo $costo; ?>">

			<input type="submit" value="Editar Mantenimiento" class="btn_save">

		</form>


		</div>
    </div>

	</section>





</body>

</html>
