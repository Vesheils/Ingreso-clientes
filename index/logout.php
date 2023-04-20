<?php
session_start();
session_unset();
session_destroy();
header("location: ../login2.html");
header("Cache-Control: no-cache, must-revalidate");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cerrar Sesión</title>
</head>
<body>
	<h1>Cerrar Sesión</h1>
	<p>Tu sesión se ha cerrado exitosamente.</p>
	<a href="login2.html">Iniciar sesión de nuevo</a>
	<?php ?>
</body>
</html>