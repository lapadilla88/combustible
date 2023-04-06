<?php
	session_start();
  $varsesion = $_SESSION["id_usuario"];
  $idusuario = $_SESSION['ididusuario'];
  $nombreusuario = $_SESSION['idnombre'];
	$usuario = $_SESSION['idusuario'];
	$tipousuario = $_SESSION['idtipo'];
	$ingusuario = $_SESSION['ingusuario'];
  $ingcontrasena = $_SESSION['ingcontrasena'];
  $ingregistro = $_SESSION['ingregistro'];
  $ingvehiculo = $_SESSION['ingvehiculo'];
  $ingconductor = $_SESSION['ingconductor'];
  $inggrifo = $_SESSION['inggrifo'];
  $ingcombustible = $_SESSION['ingcombustible'];
  $ingtipomantenimiento = $_SESSION['ingtipomantenimiento'];
  $ingvalescombustible = $_SESSION['ingvalescombustible'];
  $ingmantenimientos = $_SESSION['ingmantenimientos'];
  $repvales = $_SESSION['repvales'];
  $repvalesvehiculo = $_SESSION['repvalesvehiculo'];
  $repmantenimiento = $_SESSION['repmantenimiento'];
  $repmantenimientovehiculo = $_SESSION['repmantenimientovehiculo'];

  $codcombustible = $_SESSION["codcombustible"];

	
	if($varsesion == null || $varsesion = '') {
		echo 'Usted no tiene Autorización';
		// header("Location: bienvenidos.php");
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Cache-Control" content="no-store"/>
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Expires" content="0"/>
  <title>Sistema de Combustible</title>
  <base onMouseOver="window.status='Pagina Principal';return true">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="inicio.php" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="logout.php" class="nav-link">Cerrar Sesión</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      

      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
 
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Panel de Control</span><br>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $nombreusuario; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Catalogos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($ingvehiculo == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/vehiculo/listarvehiculo.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Vehiculos</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($ingconductor == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/conductor/listarconductor.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Conductores</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($ingcombustible == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/combustible/listarcombustible.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Combustibles</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($inggrifo == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/grifo/listargrifo.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SURTIDOR</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($ingtipomantenimiento == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/tipomantenimiento/listartipomantenimiento.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>T. Mantenimientos</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Rgistros
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($ingvalescombustible == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/vale/listarvale.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Vales de Combustible</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($ingmantenimientos == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/mantenimiento/listarmantenimiento.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Mantenimientos</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Reportes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($repvales == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/reportes/reportevales/reportevales.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte de Vales</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($repvalesvehiculo == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/reportes/reportevalesvehiculo/reportevalesvehiculo.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>R. Vales por Vehículo</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($repmantenimiento == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/reportes/reportemantenimiento/reportemantenimiento.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte Mantenimiento</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($repmantenimientovehiculo == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/reportes/reportemantenimientovehiculo/reportemantenimientovehiculo.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>R. Manteni. Vehículo</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Configuración
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($ingusuario == 'on'){ ?>              
                <li class="nav-item">
                  <a href="paginas/usuario/listarusuario.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Usuarios</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($ingcontrasena == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/usuario/cambiopass.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cambiar Contraseña</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($ingregistro == 'on'){ ?>
                <li class="nav-item">
                  <a href="paginas/evento/listarevento.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Eventos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="paginas/combustible/listarcombustibledt.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>PRUEBA TABLA</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Cerrar Sesión               
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
    <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
      <div class="nav-item dropdown">
        <a class="nav-link bg-danger dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Cerrar</a>
        <div class="dropdown-menu mt-0">
          <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all">Cerrar Todo</a>
        </div>
      </div>
      <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
      <ul class="navbar-nav overflow-hidden" role="tablist"></ul>
      <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
      <a class="nav-link bg-light" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
    </div>
    <div class="tab-content">
      
      <div class="tab-empty">
        <iframe name="contenedor" frameborder="0" src="inicio.php" height="500" width="100%">

        </iframe> 
        <h2 class="display-4">
          
         </h2>
      </div>
      <div class="tab-loading">
        
        <div>
          <h2 class="display-4">Cargando <i class="fa fa-sync fa-spin"></i></h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Sistema de Combustible </strong>

           
     
      

    <div class="float-right d-none d-sm-inline-block">
    <b >  CM-TECNOLOGIA-2023 -</b> 
    <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
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
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
