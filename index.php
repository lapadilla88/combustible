
<?php
require('conex.php');
include "conexion.php";

session_start();

if(isset($_SESSION["id_usuario"])){
  header("Location: panel");
}

if(!empty($_POST)){
    $va1 = strtoupper($_POST['usuario']);
		$var11=lista($va1);

    $va2 = strtoupper($_POST['clave']);
		$var22=lista($va2);

		$encontrado2='NO';
		if($var11 == 'SI'){
			$encontrado2='SI';
		}
    if($var22 == 'SI'){
			$encontrado2='SI';
		}

		if($encontrado2 == 'SI'){
      echo "No se permiten caracteres ni palabras especiales.";
		}else{
      $usuario = mysqli_real_escape_string($mysqli,$_POST['usuario']);
      $clave = mysqli_real_escape_string($mysqli,$_POST['clave']);
      $error = '';
      
      $sha1_pass = md5($clave);
            
      $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'  AND clave = '$sha1_pass'";
      $result=$mysqli->query($sql);
      $rows = $result->num_rows;
      
      if($rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['id_usuario'] ="idcombustible";
        $_SESSION['ididusuario'] = $row['idusuario'];
        $_SESSION['idnombre'] = $row['nombre'];
        $_SESSION['idusuario'] = $row['usuario'];
        $_SESSION['idtipo'] = $row['tipo'];
        $_SESSION['ingusuario'] = $row['ingusuario'];
        $_SESSION['ingcontrasena'] = $row['ingcontrasena'];
        $_SESSION['ingregistro'] = $row['ingregistro'];
        $_SESSION['ingvehiculo'] = $row['ingvehiculo'];
        $_SESSION['ingconductor'] = $row['ingconductor'];
        $_SESSION['inggrifo'] = $row['inggrifo'];
        $_SESSION['ingcombustible'] = $row['ingcombustible'];
        $_SESSION['ingtipomantenimiento'] = $row['ingtipomantenimiento'];
        $_SESSION['ingvalescombustible'] = $row['ingvalescombustible'];
        $_SESSION['ingmantenimientos'] = $row['ingmantenimientos'];
        $_SESSION['repvales'] = $row['repvales'];
        $_SESSION['repvalesvehiculo'] = $row['repvalesvehiculo'];
        $_SESSION['repmantenimiento'] = $row['repmantenimiento'];
        $_SESSION['repmantenimientovehiculo'] = $row['repmantenimientovehiculo'];

        $_SESSION['codcombustible'] = 'demo0001';

        
        header("location: panel");
        } else {
          echo"El Usuario o Contraseña son Incorrectos";
        }
    }
}

function lista($valor){
  $archivo = file('paginas/lista.txt');
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inicio</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script type="text/javascript">
    if (top != self) top.location.href = location.href;
  </script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Combustible</b>.</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Inicio de Sesión.</p>
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" name="usuario" class="form-control" placeholder="Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="clave" class="form-control" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
