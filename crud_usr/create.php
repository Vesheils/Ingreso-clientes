<?php
session_start();

if(!isset($_SESSION['usuario'])) {
    header('Location: login2.html');
  }
$usuario = $_SESSION['usuario'];
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de clientes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/XwpwJRVwQL00Sz"
        crossorigin="anonymous"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/create.css">
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8">
                        <h2><b>Agregar Cliente</b></h2>
                    </div>
                    <div class="col-sm-4">
                        <a href="../index/index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>
            <?php
            
            
            include("../database/database.php");

            $clientes = new Database();
            $listado = $clientes->read();
            $row = mysqli_fetch_object($listado);
            $DES_ESTADO = $row->DES_ESTADO;
            $owner= $row->USRLOG;
            $id_usr =$_SESSION['id_usuario'];
            if (isset($_POST) && !empty($_POST)) {
                $dni = $clientes->sanitize($_POST['CLIDNI']);
                $nombres = $clientes->sanitize($_POST['CLINOMBRE']);
                $apellidop = $clientes->sanitize($_POST['CLIAPELLIDOP']);
                $apellidom = $clientes->sanitize($_POST['CLIAPELLIDOM']);
                $cel = $clientes->sanitize($_POST['CLICEL']);
                $descripcion = $clientes->sanitize($_POST['CLIDESCRIPCION']);
                $estado = $clientes->sanitize($_POST['CLISTADO']);

                $res = $clientes->create($dni, $nombres, $apellidop, $apellidom, $cel, $descripcion, $estado, $id_usr);
                if ($res) {
                    $message = "Datos insertados con éxito";
                    $class = "alert alert-success";
                } else {
                    $message = "No se pudieron insertar los datos";
                    $class = "alert alert-danger";
                }

                ?>
                <div class="<?php echo $class ?>">
                    <?php echo $message; ?>
                </div>
                <?php
            }

            ?>
            <div class="container" style = " width: 800px;">
                <div class="row" style = " width: 800px;">
                    <form method="post">
                        <div class="col-md-12">
                            <div class="form-container">
                                <div class="row"  >
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Creador:</label>
                                        <label><?php echo $_SESSION['usuario'] ?></label>
                                    </div>
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nombres:</label>
                                            <input type="text" name="CLINOMBRE" id="nombres" class="form-control"
                                                maxlength="100" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>DNI:</label>
                                            <input type="text" name="CLIDNI" id="dni" class="form-control" maxlength="8"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Apellido Paterno:</label>
                                            <input type="text" name="CLIAPELLIDOP" id="apellidop" class="form-control"
                                                maxlength="100" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"> </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Apellido Materno:</label>
                                            <input type="text" name="CLIAPELLIDOM" id="apellidom" class="form-control"
                                                maxlength="100" requierd>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>¿Algo que comentar?:</label>
                                            <textarea name="CLIDESCRIPCION" id="descripcion" class="form-control"
                                                maxlength="500" requierd></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Teléfono:</label>
                                            <input type="text" name="CLICEL" id="cel" class="form-control" maxlength="9"
                                                >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Estado:</label>
                                            <select class="form-control" name="CLISTADO">
                                                <option id=1 value="1">Pendiente</option>
                                                <option id=2 value="2">Entregado</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 pull-right">
                                            <br>
                                            <button type="submit" class="btn btn-success">Guardar datos</button>
                                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>