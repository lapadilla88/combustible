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
		
		$numerovale = strtoupper($_POST['numerovale']);
		$numerovale2=lista($numerovale);

		$idvehiculo = $_POST['idvehiculo'];
		$idgrifo = $_POST['idgrifo'];
		$idconductor = $_POST['idconductor'];
		$fecha = $_POST['fecha'];
		$kilometraje = $_POST['kilometraje'];
		$galonaje = $_POST['galonaje'];
		$precio = $_POST['precio'];
      
		if($numerovale2 == 'SI'){
			$encontrado2='SI';
		}

		if($encontrado2 == 'SI'){
			$alert='<p class="msg_error">No se permiten caracteres ni palabras especiales.</p>';
		}else{
			$query = mysqli_query($conection,"SELECT * FROM vale WHERE numerovale = '$numerovale' AND token != '$token' AND codcombustible = '$codcombustible'");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El Vale ya existe.</p>';
			}else{
				$sql_update = mysqli_query($conection,"UPDATE vale SET numerovale = '$numerovale', idvehiculo=$idvehiculo, idgrifo=$idgrifo, idconductor=$idconductor, fecha='$fecha', kilometraje=$kilometraje, galonaje=$galonaje, precio=$precio 
														WHERE token= '$token' AND codcombustible = '$codcombustible'");
				
				date_default_timezone_set('America/Lima');
				$fecham = date("Y-m-d H:i:s");
				$query_insert2 = mysqli_query($conection,"INSERT INTO evento(modulo,usuario,fecha,evento,documento,codcombustible) VALUES('Vales','$usuarionombre','$fecham','Modificar','$numerovale','$codcombustible')");

				if($sql_update){
					header('Location: listarvale.php');
				}else{
					$alert='<p class="msg_error">Error al actualizar el Vale.</p>';
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
		header('Location: listarvale.php');
		mysqli_close($conection);
	}
	$token = $_REQUEST['token'];

	$sql= mysqli_query($conection,"SELECT * FROM vale WHERE token= '$token' AND codcombustible = '$codcombustible'");
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: listarvale.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...

			$numerovale = $data['numerovale'];
			$idvehiculo = $data['idvehiculo'];
			$idgrifo = $data['idgrifo'];
			$idconductor = $data['idconductor'];
			$fecha = $data['fecha'];
			$kilometraje = $data['kilometraje'];
			$galonaje = $data['galonaje'];
      		$precio = $data['precio'];

		}
	}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vales de Combustible</title>

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
			<h1>Editar Vale</h1>
			<a href="listarvale.php" class="btn_new">Regresar</a>
      	<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

		<form action="" method="post" name="form1">
				<input type="hidden" name="token" required value="<?php echo $token; ?>">
				<label for="vale">N° Vale</label>
				<input type="text" name="numerovale" id="numerovale" placeholder="N° Vale" style="text-transform:uppercase" class="tamano05" required value="<?php echo $numerovale; ?>">
				<label for="tipo">Vehículo</label>

				<?php 

					$query_rol = mysqli_query($conection,"SELECT * FROM vehiculo WHERE codcombustible = '$codcombustible'");
					$result_rol = mysqli_num_rows($query_rol);

					$query_rol2 = mysqli_query($conection,"SELECT * FROM vehiculo WHERE idvehiculo= $idvehiculo AND codcombustible = '$codcombustible'");
					$result_rol2 = mysqli_num_rows($query_rol2);          
					$rol2 = mysqli_fetch_array($query_rol2);

				 ?>

				<br><select name="idvehiculo" id="idvehiculo" placeholder="Vehículo" class="tamano03" required>
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

				<?php 

				$query_rol = mysqli_query($conection,"SELECT * FROM grifo WHERE codcombustible = '$codcombustible'");
				$result_rol = mysqli_num_rows($query_rol);

				$query_rol2 = mysqli_query($conection,"SELECT * FROM grifo WHERE idgrifo= $idgrifo AND codcombustible = '$codcombustible'");
				$result_rol2 = mysqli_num_rows($query_rol2);          
				$rol2 = mysqli_fetch_array($query_rol2);

				?>

				<br><label for="rol">Grifo</label>
				<br><select name="idgrifo" id="idgrifo" placeholder="Grifo" class="tamano02" required>
				<option value="<?php echo $rol2['idgrifo']; ?>"><?php echo $rol2['nombregrifo'] . ' - ' . $rol2['rucgrifo'];?></option>
				<option value="">(Seleccionar)</option>
				<?php 
					if($result_rol > 0)
					{
						while ($rol = mysqli_fetch_array($query_rol)) {
				?>
						<option value="<?php echo $rol['idgrifo']; ?>"><?php echo $rol['nombregrifo'] . ' - ' . $rol['rucgrifo']; ?></option>
				<?php 
							# code...
						}
						
					}
				?>
				</select>

				<script type="text/javascript">
				$(document).ready(function(){
				$('#idgrifo').select2();
				});
				</script>

				<br><label for="rol">Conductor</label>
				<?php 

				$query_rol = mysqli_query($conection,"SELECT * FROM conductor WHERE codcombustible = '$codcombustible'");
				$result_rol = mysqli_num_rows($query_rol);

				$query_rol2 = mysqli_query($conection,"SELECT * FROM conductor WHERE idconductor= $idconductor AND codcombustible = '$codcombustible'");
				$result_rol2 = mysqli_num_rows($query_rol2);          
				$rol2 = mysqli_fetch_array($query_rol2);

				?>

				<br><select name="idconductor" id="idconductor" placeholder="Conductor" class="tamano02" required>
				<option value="<?php echo $rol2['idconductor']; ?>"><?php echo $rol2['nombreconductor'] . ' - ' . $rol2['dni'];?></option>
				<option value="">(Seleccionar)</option>
				<?php 
					if($result_rol > 0)
					{
						while ($rol = mysqli_fetch_array($query_rol)) {
				?>
						<option value="<?php echo $rol['idconductor']; ?>"><?php echo $rol['nombreconductor'] . ' - ' . $rol['dni'];; ?></option>
				<?php 
							# code...
						}
						
					}
				?>
				</select>

				<script type="text/javascript">
				$(document).ready(function(){
				$('#idconductor').select2();
				});				
				</script>

				<br><label for="fecha">Fecha</label>
				<input type="date" name="fecha" id="fecha" placeholder="Fecha" required value="<?php echo $fecha; ?>">
				<label for="kilometraje">Kilometraje</label>
				<input type="number" name="kilometraje" id="kilometraje" class="tamano05" onfocus="if(this.value == '0') {this.value=''}" onblur="if(this.value == ''){this.value ='0'}"  required value="<?php echo $kilometraje; ?>">

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
				var t1 = document.form1.galonaje.value;
				var t2 = document.form1.precio.value;
				var t3= t1 * t2;

				document.form1.galonaje.value = redondea(t1,nDec);
				document.form1.precio.value = redondea(t2,nDec);
				document.form1.total.value = redondea(t3,nDec);
  				}

				</script>

				<label for="galonaje">Galonaje</label>
				<input type="number" name="galonaje" id="galonaje" class="tamano05" step="0.01" onChange="calcula('+',2)" onfocus="if(this.value == '0.00') {this.value=''}" onblur="if(this.value == ''){this.value ='0.00'}"  required value="<?php echo $galonaje; ?>">
				<label for="precio">Precio</label>
				<input type="number" name="precio" id="precio" class="tamano05" step="0.01" onChange="calcula('+',2)" onfocus="if(this.value == '0.00') {this.value=''}" onblur="if(this.value == ''){this.value ='0.00'}"  required value="<?php echo $precio; ?>">   		
				<label for="precio">Total</label>
				<input type="number" name="total" id="total" class="tamano05"  readonly value="<?php echo ($galonaje * $precio); ?>">
				


				<input type="submit" value="Actualizar Vale" class="btn_save">

			</form>


		</div>
    </div>

	</section>





</body>

</html>
