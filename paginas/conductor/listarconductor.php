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
  <title>conductors</title>

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
		
		<h1>Lista de Conductores</h1>
		<a href="registroconductor.php" class="btn_new">Crear Conductor</a>
		
		<form action="listarconductor.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" style="text-transform:uppercase">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>Nombres</th>
				<th>CI</th>
				<th>Licencia</th>
				<th>Categoria</th>
				<th>Telefono</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM conductor");
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
				$query = mysqli_query($conection,"SELECT idconductor, token, nombreconductor, dni, licencia, categoria, telefonoconductor FROM conductor 
													WHERE codcombustible = '$codcombustible' ORDER BY nombreconductor");
			}else{
				$query = mysqli_query($conection,"SELECT idconductor, token, nombreconductor, dni, licencia, categoria, telefonoconductor FROM conductor 
													WHERE (nombreconductor LIKE '%$busqueda%' OR dni LIKE '%$busqueda%' OR licencia LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%' OR telefonoconductor LIKE '%$busqueda%') and codcombustible = '$codcombustible' ORDER BY nombreconductor");
			}

			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data['nombreconductor']; ?></td>
					<td><?php echo $data['dni']; ?></td>
					<td><?php echo $data['licencia']; ?></td>
					<td><?php echo $data['categoria']; ?></td>
					<td><?php echo $data['telefonoconductor']; ?></td>
					<td>
						<a class="link_edit" href="editarconductor.php?token=<?php echo $data['token']; ?>">Editar</a>
						
						<a class="link_delete" href="eliminarconductor.php?token=<?php echo $data['token']; ?>">Eliminar</a>
						
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
