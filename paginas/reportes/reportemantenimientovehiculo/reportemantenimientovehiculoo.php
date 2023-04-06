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
	include 'plantilla.php';
	require '../../../conexion.php';
	require '../../../conex.php';

	$fechai = $_POST['fechai'];
	$fechaf = $_POST['fechaf'];
	$idvehiculo = $_POST['idvehiculo'];

	$query = mysqli_query($conection,"SELECT * FROM vehiculo WHERE idvehiculo = $idvehiculo AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$fecha1 = $fechai;
	$fecha2 = $fechaf;
	$placa = $data['placa'];
	$tipo = $data['tipo'];
	$anofabricacion = $data['anofabricacion'];
	$marca = $data['marca'];

	if(empty($_POST['fechai']) OR empty($_POST['fechaf'])){

		$query = "SELECT mantenimiento.idmantenimiento, mantenimiento.numeromantenimiento, vehiculo.placa, tipomantenimiento.nombretipomantenimiento, mantenimiento.fechamantenimiento, mantenimiento.fechapmantenimiento, mantenimiento.kilometraje, mantenimiento.costo FROM mantenimiento  
					INNER JOIN vehiculo ON mantenimiento.idvehiculo = vehiculo.idvehiculo 
					INNER JOIN tipomantenimiento ON mantenimiento.idtipomantenimiento = tipomantenimiento.idtipomantenimiento 
					WHERE vehiculo.idvehiculo LIKE '%$idvehiculo%' AND tipomantenimiento.idtipomantenimiento LIKE '%$idtipomantenimiento%'AND mantenimiento.codcombustible='$codcombustible' ORDER BY mantenimiento.fechamantenimiento DESC";

	}else{
		$query = "SELECT mantenimiento.idmantenimiento, mantenimiento.numeromantenimiento, vehiculo.placa, tipomantenimiento.nombretipomantenimiento, mantenimiento.fechamantenimiento, mantenimiento.fechapmantenimiento, mantenimiento.kilometraje, mantenimiento.costo FROM mantenimiento  
					INNER JOIN vehiculo ON mantenimiento.idvehiculo = vehiculo.idvehiculo 
					INNER JOIN tipomantenimiento ON mantenimiento.idtipomantenimiento = tipomantenimiento.idtipomantenimiento 
					WHERE mantenimiento.fechamantenimiento BETWEEN '$fechai' AND '$fechaf' AND vehiculo.idvehiculo LIKE '%$idvehiculo%'  ORDER BY mantenimiento.fechamantenimiento DESC"; 
	}

	$resultado = $mysqli->query($query);
	
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetXY(10,25);
	$pdf->SetFont('Arial','B',12);
	if(empty($_POST['fechai']) OR empty($_POST['fechaf'])){
		$pdf->Cell(190,6,utf8_decode('Reporte General'),0,1,'L');
	}else{
		$pdf->Cell(190,6,utf8_decode('Reporte Del ' . $fecha1 . ' al ' . $fecha2),0,1,'L');
	}
	$pdf->Cell(80,6,utf8_decode('Placa: ' . $placa),0,0,'L');
	$pdf->Cell(80,6,utf8_decode('Tipo: ' . $tipo),0,1,'L');
	$pdf->Cell(80,6,utf8_decode('A. Fabricación: ' . $anofabricacion),0,0,'L');
	$pdf->Cell(80,6,utf8_decode('Marca: ' . $marca),0,1,'L');
	$pdf->Cell(190,6,utf8_decode(' '),0,1,'C');


	$pdf->SetX(10);
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(30,6,utf8_decode('N° Mantenimie.'),1,0,'C',1);
	$pdf->Cell(85,6,utf8_decode('Tipo Mantenimiento'),1,0,'C',1);
	$pdf->Cell(20,6,utf8_decode('Fecha'),1,0,'C',1);
	$pdf->Cell(25,6,utf8_decode('Fecha Pro.'),1,0,'C',1);
	$pdf->Cell(15,6,utf8_decode('Kilometr.'),1,0,'C',1);
	$pdf->Cell(15,6,utf8_decode('Costo'),1,1,'C',1);
	
	$pdf->SetFont('Arial','',7);
	$pdf->SetWidths(array(30,85,20,25,15,15));
	$pdf->SetAligns(array('C','L','C','C','R','R'));
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Row(array(utf8_decode($row['numeromantenimiento']),utf8_decode($row['nombretipomantenimiento']),utf8_decode($row['fechamantenimiento']),utf8_decode($row['fechapmantenimiento']),utf8_decode($row['kilometraje']),number_format(utf8_decode($row['costo']),2)));
	}

	if(empty($_POST['fechai']) OR empty($_POST['fechaf'])){

		$query = "SELECT sum(mantenimiento.costo)AS total FROM mantenimiento  
					INNER JOIN vehiculo ON mantenimiento.idvehiculo = vehiculo.idvehiculo 
					INNER JOIN tipomantenimiento ON mantenimiento.idtipomantenimiento = tipomantenimiento.idtipomantenimiento 
					WHERE vehiculo.idvehiculo LIKE '%$idvehiculo%' AND tipomantenimiento.idtipomantenimiento LIKE '%$idtipomantenimiento%'AND mantenimiento.codcombustible='$codcombustible' ORDER BY mantenimiento.fechamantenimiento DESC";

	}else{
		$query = "SELECT sum(mantenimiento.costo)AS total FROM mantenimiento  
					INNER JOIN vehiculo ON mantenimiento.idvehiculo = vehiculo.idvehiculo 
					INNER JOIN tipomantenimiento ON mantenimiento.idtipomantenimiento = tipomantenimiento.idtipomantenimiento 
					WHERE mantenimiento.fechamantenimiento BETWEEN '$fechai' AND '$fechaf' AND vehiculo.idvehiculo LIKE '%$idvehiculo%' ORDER BY mantenimiento.fechamantenimiento DESC";
	}

	$query = mysqli_query($conection,$query);
	$data = mysqli_fetch_array($query);
	$total = number_format($data['total'],2);

	$pdf->SetX(10);
	$pdf->SetFont('Arial','B',10);

	$pdf->Cell(135,6,utf8_decode(' '),0,0,'C');
	$pdf->Cell(55,6,utf8_decode('Total :  ' . $total),1,1,'R');

	$pdf->Output();
?>