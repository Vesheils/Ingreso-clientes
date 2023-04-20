<?php
session_start();

header("Cache-Control: no-cache, must-revalidate");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  include('../../database/database.php');
  $conexion=mysqli_connect("localhost","root","","comput_house")or die("error de conexion");
  $usuario = $_POST['username'];
  $password = $_POST['password'];

  $consulta="SELECT * FROM usuario WHERE BINARY USRNOMBRE='$usuario' AND USRCLAVE='$password'";
  $resultado=mysqli_query($conexion,$consulta);

  $filas=mysqli_num_rows($resultado);

  if($filas){
    $row = mysqli_fetch_object($resultado);
    $_SESSION['usuario'] = $usuario;
    $_SESSION['id_usuario'] = $row->USRID;
    $_SESSION['log_usuario'] = $row->USRLOG;
        
    if ($row->tipo_id == 1) {
      header("location:index/index_adm.php");
    }else {
      header("location:index/index.php");
    }
    exit();
  } else {
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <title>Error de autenticación</title>
      </head>
      <body>
        <h1>Error de autenticación</h1>
        <p>Los datos de inicio de sesión no son válidos. Por favor, inténtalo de nuevo.</p>
        <a href="login2.html">Volver al formulario de inicio de sesión</a>
      </body>
    </html>
    <?php
  }
  mysqli_free_result($resultado);
  mysqli_close($conexion);
} else {
  header("location: login2.html");
}
?>

