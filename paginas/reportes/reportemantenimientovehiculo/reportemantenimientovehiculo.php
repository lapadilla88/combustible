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

	include "../../../conexion.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reporte Mantenimiento</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link href="../../css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../select2/select2.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js" 
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script src="../../select2/select2.min.js"></script>

</head>
<body>

<section id="container">
	<div class="margen">
	<div class="form_register">
			<h1>Reporte de Mantenimiento por Vehículo</h1>

			<form action="reportemantenimientovehiculoo.php" method="post" name="form1">
			<label for="numero">Fecha Inicial</label>
			<input type="date" name="fechai" id="fechai" class="tamano04">
        	<label for="numero">Fecha Final</label>
			  <input type="date" name="fechaf" id="fechaf" class="tamano04">
				<label for="tipo">Vehículo</label>

				<?php 

					$query_rol = mysqli_query($conection,"SELECT * FROM vehiculo WHERE codcombustible = '$codcombustible'");
					$result_rol = mysqli_num_rows($query_rol);

				 ?>

				<br><select name="idvehiculo" id="idvehiculo" placeholder="Vehículo" class="tamano03" required>
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


				<input type="submit" value="PDF" class="btn_save">

			</form>


	</div>
	</div>
</section>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#idvehiculo').select2();
		$('#idtipomantenimiento').select2();
	});
</script>
