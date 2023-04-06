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
  <title>Mantenimientos</title>

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
		
		<h1>Lista de Mantenimientos</h1>
		<a href="registromantenimiento.php" class="btn_new">Crear Mantenimiento</a>
		
		<form action="listarmantenimiento.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" style="text-transform:uppercase">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>N° Mantenimiento</th>
				<th>Vehículo</th>
				<th>T. Mantenimiento</th>
				<th>Fecha Mantenimiento</th>
				<th>Fecha Próxima</th>
				<th>Kilometraje</th>
				<th>Costo Bs</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM mantenimiento");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			if (sizeof($_REQUEST)>0) {
				$busqueda = strtoupper($_REQUEST['busqueda']);
				$busqueda2=lista($busqueda);
			} else {
					$busqueda = "";
				$busqueda2="";
			}
			//$busqueda = strtoupper($_REQUEST['busqueda']);
			//$busqueda2=lista($busqueda);

			$encontrado2='NO';
			if($busqueda2 == 'SI'){
				$encontrado2='SI';
			}

			if($encontrado2 == 'SI'){
				$query = mysqli_query($conection,"SELECT mantenimiento.idmantenimiento, mantenimiento.token, mantenimiento.numeromantenimiento, vehiculo.placa, tipomantenimiento.nombretipomantenimiento, mantenimiento.fechamantenimiento, mantenimiento.fechapmantenimiento, mantenimiento.kilometraje, mantenimiento.costo FROM mantenimiento 
													INNER JOIN vehiculo ON mantenimiento.idvehiculo = vehiculo.idvehiculo 
													INNER JOIN tipomantenimiento ON tipomantenimiento.idtipomantenimiento = mantenimiento.idtipomantenimiento 
													WHERE mantenimiento.codcombustible = '$codcombustible' ORDER BY mantenimiento.fechamantenimiento DESC");
			}else{
				$query = mysqli_query($conection,"SELECT mantenimiento.idmantenimiento, mantenimiento.token, mantenimiento.numeromantenimiento, vehiculo.placa, tipomantenimiento.nombretipomantenimiento, mantenimiento.fechamantenimiento, mantenimiento.fechapmantenimiento, mantenimiento.kilometraje, mantenimiento.costo FROM mantenimiento 
													INNER JOIN vehiculo ON mantenimiento.idvehiculo = vehiculo.idvehiculo 
													INNER JOIN tipomantenimiento ON tipomantenimiento.idtipomantenimiento = mantenimiento.idtipomantenimiento 
													WHERE (mantenimiento.numeromantenimiento LIKE '%$busqueda%' OR vehiculo.placa LIKE '%$busqueda%' OR tipomantenimiento.nombretipomantenimiento LIKE '%$busqueda%' OR mantenimiento.fechamantenimiento LIKE '%$busqueda%' OR mantenimiento.fechapmantenimiento LIKE '%$busqueda%') and mantenimiento.codcombustible = '$codcombustible' ORDER BY mantenimiento.fechamantenimiento DESC");
			}
			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data['numeromantenimiento']; ?></td>
					<td><?php echo $data['placa']; ?></td>
					<td><?php echo $data['nombretipomantenimiento']; ?></td>
					<td><?php echo $data['fechamantenimiento']; ?></td>
					<td><?php echo $data['fechapmantenimiento']; ?></td>
					<td><?php echo $data['kilometraje']; ?></td>
					<td ><?php echo number_format($data['costo'],2); ?></td>
					<td>
						<a class="link_edit" href="editarmantenimiento.php?token=<?php echo $data['token']; ?>">Editar</a>
						
						<a class="link_delete" href="eliminarmantenimiento.php?token=<?php echo $data['token']; ?>">Eliminar</a>
						
					</td>
				</tr>
			
		<?php 
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

		</table>
	</div>
</section>

</body>
</html>
