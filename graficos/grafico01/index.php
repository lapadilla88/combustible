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

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>amCharts V4 Example - simple-bar-chart</title>
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <div id="chartdiv"></div>
    <script src="../core.js"></script>
    <script src="../charts.js"></script>
    <script src="../themes/animated.js"></script>

  </body>
</html>

<?php
  $fechaano = date("Y");
  $query = mysqli_query($conection,"SELECT SUM(galonaje*precio)AS total FROM vale WHERE MONTH(fecha) = 01 AND YEAR(fecha) = $fechaano AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$enero = $data['total'];
  if (is_null($enero)){
    $enero = 0;
  }

  $query = mysqli_query($conection,"SELECT SUM(galonaje*precio)AS total FROM vale WHERE MONTH(fecha) = 02 AND YEAR(fecha) = $fechaano AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$febrero = $data['total'];
  if (is_null($febrero)){
    $febrero = 0;
  }

  $query = mysqli_query($conection,"SELECT SUM(galonaje*precio)AS total FROM vale WHERE MONTH(fecha) = 03 AND YEAR(fecha) = $fechaano AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$marzo = $data['total'];
  if (is_null($marzo)){
    $marzo = 0;
  }

  $query = mysqli_query($conection,"SELECT SUM(galonaje*precio)AS total FROM vale WHERE MONTH(fecha) = 04 AND YEAR(fecha) = $fechaano AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$abril = $data['total'];
  if (is_null($abril)){
    $abril = 0;
  }

  $query = mysqli_query($conection,"SELECT SUM(galonaje*precio)AS total FROM vale WHERE MONTH(fecha) = 05 AND YEAR(fecha) = $fechaano AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$mayo = $data['total'];
  if (is_null($mayo)){
    $mayo = 0;
  }

  $query = mysqli_query($conection,"SELECT SUM(galonaje*precio)AS total FROM vale WHERE MONTH(fecha) = 06 AND YEAR(fecha) = $fechaano AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$junio = $data['total'];
  if (is_null($junio)){
    $junio = 0;
  }

  $query = mysqli_query($conection,"SELECT SUM(galonaje*precio)AS total FROM vale WHERE MONTH(fecha) = 07 AND YEAR(fecha) = $fechaano AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$julio = $data['total'];
  if (is_null($julio)){
    $julio = 0;
  }

  $query = mysqli_query($conection,"SELECT SUM(galonaje*precio)AS total FROM vale WHERE MONTH(fecha) = 08 AND YEAR(fecha) = $fechaano AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$agosto = $data['total'];
  if (is_null($agosto)){
    $agosto = 0;
  }

  $query = mysqli_query($conection,"SELECT SUM(galonaje*precio)AS total FROM vale WHERE MONTH(fecha) = 09 AND YEAR(fecha) = $fechaano AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$setiembre = $data['total'];
  if (is_null($setiembre)){
    $setiembre = 0;
  }

  $query = mysqli_query($conection,"SELECT SUM(galonaje*precio)AS total FROM vale WHERE MONTH(fecha) = 10 AND YEAR(fecha) = $fechaano AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$octubre = $data['total'];
  if (is_null($octubre)){
    $octubre = 0;
  }

  $query = mysqli_query($conection,"SELECT SUM(galonaje*precio)AS total FROM vale WHERE MONTH(fecha) = 11 AND YEAR(fecha) = $fechaano AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$noviembre = $data['total'];
  if (is_null($noviembre)){
    $noviembre = 0;
  }

  $query = mysqli_query($conection,"SELECT SUM(galonaje*precio)AS total FROM vale WHERE MONTH(fecha) = 12 AND YEAR(fecha) = $fechaano AND codcombustible='$codcombustible'");
	$data = mysqli_fetch_array($query);
	$diciembre = $data['total'];
  if (is_null($diciembre)){
    $diciembre = 0;
  }

?>

<script>

  var enero = <?php echo $enero; ?>;
  var febrero = <?php echo $febrero; ?>;
  var marzo = <?php echo $marzo; ?>;
  var abril = <?php echo $abril; ?>;
  var mayo = <?php echo $mayo; ?>;
  var junio = <?php echo $junio; ?>;
  var julio = <?php echo $julio; ?>;
  var agosto = <?php echo $agosto; ?>;
  var setiembre = <?php echo $setiembre; ?>;
  var octubre = <?php echo $octubre; ?>;
  var noviembre = <?php echo $noviembre; ?>;
  var diciembre = <?php echo $diciembre; ?>;



  am4core.useTheme(am4themes_animated);

  var chart = am4core.create("chartdiv", am4charts.XYChart);


  chart.colors.saturation = 0.4;

  chart.data = [{
    "country": "Dic",
    "visits": diciembre
  }, {
    "country": "Nov",
    "visits": noviembre
  }, {
    "country": "Oct",
    "visits": octubre
  }, {
    "country": "Set",
    "visits": setiembre
  }, {
    "country": "Ago",
    "visits": agosto
  }, {
    "country": "Jul",
    "visits": julio
  }, {
    "country": "Jun",
    "visits": junio
  }, {
    "country": "May",
    "visits": mayo
  }, {
    "country": "Abr",
    "visits": abril
  }, {
    "country": "Mar",
    "visits": marzo
  }, {
    "country": "Feb",
    "visits": febrero
  }, {
    "country": "Ene",
    "visits": enero
  }];


  var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.dataFields.category = "country";
  categoryAxis.renderer.minGridDistance = 20;

  var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.maxLabelPosition = 0.98;

  var series = chart.series.push(new am4charts.ColumnSeries());
  series.dataFields.categoryY = "country";
  series.dataFields.valueX = "visits";
  series.tooltipText = "{valueX.value}";
  series.sequencedInterpolation = true;
  series.defaultState.transitionDuration = 1000;
  series.sequencedInterpolationDelay = 100;
  series.columns.template.strokeOpacity = 0;

  chart.cursor = new am4charts.XYCursor();
  chart.cursor.behavior = "panY";


  // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
  series.columns.template.adapter.add("fill", function (fill, target) {
    return chart.colors.getIndex(target.dataItem.index);
  });
</script>