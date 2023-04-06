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

		$query = "SELECT vale.idvale, vale.numerovale, vehiculo.placa, grifo.nombregrifo, vale.fecha, vale.galonaje, vale.precio, combustible.nombrecombustible, ( vale.galonaje * vale.precio)AS total FROM vale  
					INNER JOIN vehiculo ON vale.idvehiculo = vehiculo.idvehiculo 
					INNER JOIN grifo ON vale.idgrifo = grifo.idgrifo 
					INNER JOIN conductor ON vale.idconductor = conductor.idconductor
					INNER JOIN combustible ON vehiculo.idcombustible = combustible.idcombustible
					WHERE vehiculo.idvehiculo LIKE '%$idvehiculo%' AND vale.codcombustible='$codcombustible' ORDER BY vale.fecha DESC";

	}else{
		$query = "SELECT vale.idvale, vale.numerovale, vehiculo.placa, grifo.nombregrifo, vale.fecha, vale.galonaje, vale.precio, combustible.nombrecombustible, ( vale.galonaje * vale.precio)AS total FROM vale  
					INNER JOIN vehiculo ON vale.idvehiculo = vehiculo.idvehiculo 
					INNER JOIN grifo ON vale.idgrifo = grifo.idgrifo 
					INNER JOIN conductor ON vale.idconductor = conductor.idconductor
					INNER JOIN combustible ON vehiculo.idcombustible = combustible.idcombustible
					WHERE vale.fecha BETWEEN '$fechai' AND '$fechaf' AND vehiculo.idvehiculo LIKE '%$idvehiculo%' AND vale.codcombustible='$codcombustible' ORDER BY vale.fecha DESC";
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
	$pdf->Cell(30,6,utf8_decode('N° Vale'),1,0,'C',1);
	$pdf->Cell(70,6,utf8_decode('Grifo'),1,0,'C',1);
	$pdf->Cell(20,6,utf8_decode('Fecha'),1,0,'C',1);
	$pdf->Cell(25,6,utf8_decode('Combustible'),1,0,'C',1);
	$pdf->Cell(15,6,utf8_decode('Galonaje'),1,0,'C',1);
	$pdf->Cell(15,6,utf8_decode('Precio'),1,0,'C',1);
	$pdf->Cell(15,6,utf8_decode('Total'),1,1,'C',1);
	
	$pdf->SetFont('Arial','',7);
	$pdf->SetWidths(array(30,70,20,25,15,15,15));
	$pdf->SetAligns(array('C','L','C','C','R','R','R'));
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Row(array(utf8_decode($row['numerovale']),utf8_decode($row['nombregrifo']),utf8_decode($row['fecha']),utf8_decode($row['nombrecombustible']),number_format(utf8_decode($row['galonaje']),2),number_format(utf8_decode($row['precio']),2),number_format(utf8_decode($row['total']),2)));
	}

	if(empty($_POST['fechai']) OR empty($_POST['fechaf'])){

		$query = "SELECT sum( vale.galonaje * vale.precio)AS total FROM vale  
					INNER JOIN vehiculo ON vale.idvehiculo = vehiculo.idvehiculo 
					INNER JOIN grifo ON vale.idgrifo = grifo.idgrifo 
					INNER JOIN conductor ON vale.idconductor = conductor.idconductor
					INNER JOIN combustible ON vehiculo.idcombustible = combustible.idcombustible
					WHERE vehiculo.idvehiculo LIKE '%$idvehiculo%' AND grifo.idgrifo LIKE '%$idgrifo%' AND combustible.idcombustible LIKE '%$idcombustible%' AND vale.codcombustible='$codcombustible' ORDER BY vale.fecha DESC";

	}else{
		$query = "SELECT sum( vale.galonaje * vale.precio)AS total FROM vale  
					INNER JOIN vehiculo ON vale.idvehiculo = vehiculo.idvehiculo 
					INNER JOIN grifo ON vale.idgrifo = grifo.idgrifo 
					INNER JOIN conductor ON vale.idconductor = conductor.idconductor
					INNER JOIN combustible ON vehiculo.idcombustible = combustible.idcombustible
					WHERE vale.fecha BETWEEN '$fechai' AND '$fechaf' AND vehiculo.idvehiculo LIKE '%$idvehiculo%'  AND vale.codcombustible='$codcombustible' ORDER BY vale.fecha DESC"; 
	}

	$query = mysqli_query($conection,$query);
	$data = mysqli_fetch_array($query);
	$total = number_format($data['total'],2);

	$pdf->SetX(10);
	$pdf->SetFont('Arial','B',10);

	$pdf->Cell(145,6,utf8_decode(' '),0,0,'C');
	$pdf->Cell(45,6,utf8_decode('Total :  ' . $total),1,1,'R');

	$pdf->Output();
?>