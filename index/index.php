<?php
 session_start();
 if (!isset($_SESSION['usuario'])) {
     header("location: login2.html");
     exit();
 }

 $usuario = $_SESSION['usuario'];
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="table-wrapper">
            <table id="tabla_asistencias" class="table table-bordered table-condensed table-hover responsive">
            <div class="table-title">
                <div class="row align-items-start">
                    <div class="col-sm-8">
                        <h2>Listado de <b>Clientes</b></h2>
                    </div>
                    <div class="row align-items-end">
                    <div class="col-md-4 offset-md-4" style="max-width: 310px; position: relative; left:129px;">
                        <a href="../login2.html" class="btn btn-danger"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
                        <a href="../crud_usr/create.php" class="btn btn-info"><i class="fa fa-plus"></i> Agregar cliente</a>
                    </div>
                </div>
            </div>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Creador</th>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Teléfono</th>
                        <th>Comentario</th>
                        <th>Estado</th>
                        <th>Creacion</th>
                        <th>Ultima Modificacion</th>
                    </tr>
                </thead>
                <?php
               

               include '../database/database.php';
                $clientes = new Database();
                $listado = $clientes->read();

                ?>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_object($listado)) {
                        $owner = $row->USRLOG;
                        $id = $row->CLIID;
                        $dni = $row->CLIDNI;
                        $nombres = $row->CLINOMBRE . " " . $row->CLIAPELLIDOP . " " . $row->CLIAPELLIDOM;
                        $descripcion = $row->CLIDESCRIPCION;
                        $cel = $row->CLICEL;
                        $fech = $row->CLIFECHA;
                        $fechudt = $row->CLIUPDATE;
                        $estado = $row->DES_ESTADO;

                        ?>
                        <tr>
                            <td>
                                <?php echo $owner; ?>
                            </td>
                            <td>
                                <?php echo $dni; ?>
                            </td>
                            <td>
                                <?php echo $nombres; ?>
                            </td>
                            <td>
                                <?php echo $cel; ?>
                            </td>
                            <td>
                                <?php echo (strlen($descripcion) > 50) ? substr($descripcion, 0, 50) . "..." : $descripcion; ?>

                            </td>
                            <td>
                                <?php echo $fech; ?>
                            </td>
                            <td>
                                <?php echo $fechudt; ?>
                            </td>
                            <td>
                                <?php echo $estado; ?>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>