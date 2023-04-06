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
  <title>grifos</title>

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
		
		<h1>Lista de Surtidor</h1>
		<a href="registrogrifo.php" class="btn_new">Crear Surtidor</a>
		
		<form action="listargrifo.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" style="text-transform:uppercase">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>Razón Social</th>
				<th>NIT</th>
				<th>Dirección</th>
				<th>Teléfono</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM grifo");
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
				$query = mysqli_query($conection,"SELECT idgrifo, token, nombregrifo, rucgrifo, direcciongrifo, telefonogrifo FROM grifo 
													WHERE codcombustible = '$codcombustible' ORDER BY nombregrifo");
			}else{										
				$query = mysqli_query($conection,"SELECT idgrifo, token, nombregrifo, rucgrifo, direcciongrifo, telefonogrifo FROM grifo 
													WHERE (nombregrifo LIKE '%$busqueda%' OR rucgrifo LIKE '%$busqueda%' OR direcciongrifo LIKE '%$busqueda%' OR telefonogrifo LIKE '%$busqueda%') and codcombustible = '$codcombustible' ORDER BY nombregrifo");
			}

			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data['nombregrifo']; ?></td>
					<td><?php echo $data['rucgrifo']; ?></td>
					<td><?php echo $data['direcciongrifo']; ?></td>
					<td><?php echo $data['telefonogrifo']; ?></td>
					<td>
						<a class="link_edit" href="editargrifo.php?token=<?php echo $data['token']; ?>">Editar</a>
						
						<a class="link_delete" href="eliminargrifo.php?token=<?php echo $data['token']; ?>">Eliminar</a>						
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
