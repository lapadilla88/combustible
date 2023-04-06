<?php
	session_start();
  	$varsesion = $_SESSION["id_usuario"];
	$usuario = $_SESSION['idusuario'];
	$codcombustible = $_SESSION["codcombustible"];	
	
	if($varsesion == null || $varsesion = '') {
		echo 'Usted no tiene Autorización';
		// header("Location: bienvenidos.php");
		die();
	}

	include "../../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Eventos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<section id="container">
	<div class="margen">
		
		<h1>Lista de Eventos</h1>
		
		<form action="listarevento.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>Modulo</th>
				<th>Usuario</th>
				<th>Fecha</th>
				<th>Evento</th>
				<th>Documento</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_evento FROM evento");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_evento = $result_register['total_evento'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_evento / $por_pagina);

			if (sizeof($_REQUEST)>0) {
				$busqueda = strtoupper($_REQUEST['busqueda']);
				$busqueda2=lista($busqueda);
			} else {
					$busqueda = "";
				$busqueda2="";
			}
			//$busqueda = strtolower($_REQUEST['busqueda']);

			$query = mysqli_query($conection,"SELECT modulo, usuario, fecha, evento, documento FROM evento 
												WHERE(modulo LIKE '%$busqueda%' OR usuario LIKE '%$busqueda%' OR fecha LIKE '%$busqueda%' OR evento LIKE '%$busqueda%' OR documento LIKE '%$busqueda%') AND codcombustible = '$codcombustible' ORDER BY fecha DESC");

			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data['modulo']; ?></td>
					<td><?php echo $data['usuario']; ?></td>
					<td><?php echo $data['fecha']; ?></td>
					<td><?php echo $data['evento']; ?></td>
					<td><?php echo $data['documento']; ?></td>
				</tr>
			
		<?php 
				}

			}
		 ?>

		</table>
	</div>
</section>

</body>
</html>
