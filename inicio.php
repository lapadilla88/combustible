<?php
	session_start();
  $varsesion = $_SESSION["id_usuario"];
	$usuarionombre = $_SESSION['idnombre'];
	$codcombustible = $_SESSION["codcombustible"];


  $ingvehiculo = $_SESSION['ingvehiculo'];
  $ingconductor = $_SESSION['ingconductor'];
  $ingvalescombustible = $_SESSION['ingvalescombustible'];
  $ingmantenimientos = $_SESSION['ingmantenimientos'];
	
	if($varsesion == null || $varsesion = '') {
		echo 'Usted no tiene Autorización';
		// header("Location: bienvenidos.php");
		die();
	}

	include "conexion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 https://ionic.io/ionicons/v2/cheatsheet.html -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <?php
                $query = mysqli_query($conection,"SELECT COUNT(*) AS vales FROM vale WHERE codcombustible='$codcombustible'");
                $data = mysqli_fetch_array($query);
                $vales = $data['vales'];
              ?>
              <h3><?php echo $vales; ?></h3>

              <p>Vales de Combustible</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-clipboard"></i>
            </div>
            <?php if ($ingvalescombustible == 'on'){ ?>
              <a href="paginas/vale/listarvale.php" class="small-box-footer" class="nav-link">Más Información <i class="fas fa-arrow-circle-right"></i> </a>
            <?php }else{ ?>
              <a href="#" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <?php
                $query = mysqli_query($conection,"SELECT COUNT(*) AS mante FROM mantenimiento WHERE codcombustible='$codcombustible'");
                $data = mysqli_fetch_array($query);
                $mante = $data['mante'];
              ?>
              <h3><?php echo $mante; ?></h3>

              <p>Mantenimientos</p>
            </div>
            <div class="icon">
              <i class="ion ion-wrench"></i>
            </div>
            <?php if ($ingmantenimientos == 'on'){ ?>
              <a href="paginas/tipomantenimiento/listartipomantenimiento.php" class="small-box-footer" class="nav-link">Más Información <i class="fas fa-arrow-circle-right"></i> </a>
            <?php }else{ ?>
              <a href="#" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <?php
                $query = mysqli_query($conection,"SELECT COUNT(*) AS vehi FROM vehiculo WHERE codcombustible='$codcombustible'");
                $data = mysqli_fetch_array($query);
                $vehi = $data['vehi'];
              ?>
              <h3><?php echo $vehi; ?></h3>

              <p>Vehículos</p>
            </div>
            <div class="icon">
              <i class="ion ion-model-s"></i>
            </div>
            <?php if ($ingvehiculo == 'on'){ ?>
              <a href="paginas/vehiculo/listarvehiculo.php"class="small-box-footer" class="nav-link">Más Información <i class="fas fa-arrow-circle-right"></i></a>
            <?php }else{ ?>
              <a href="#"class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <?php
                $query = mysqli_query($conection,"SELECT COUNT(*) AS cond FROM conductor WHERE codcombustible='$codcombustible'");
                $data = mysqli_fetch_array($query);
                $cond = $data['cond'];
              ?>
              <h3><?php echo $cond; ?></h3>

              <p>Conductores</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <?php if ($ingconductor == 'on'){ ?>
              <a href="paginas/conductor/listarconductor.php" class="small-box-footer" class="nav-link">Más Información <i class="fas fa-arrow-circle-right"></i> </a>
            <?php }else{ ?>
              <a href="#" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <style>
        .borde{
          width: 100%;
          margin: 10px;
        }
      </style>
      <div class="row">
      <div class="borde">
        <h5> Gráfico de Vales <?php echo $fechaano = date("Y"); ?></h5>      
        <iframe src="graficos/grafico01/index.php" width="100%" height="400"></iframe>
      </div>
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

 
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
