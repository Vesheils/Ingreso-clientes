<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header('Location: login2.html');
  }
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
    <link rel="stylesheet" href="../../css/create.css">
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8">
                        <h2><b>Agregar Nuevo Usuario</b></h2>
                    </div>
                    <div class="col-sm-4">
                        <a href="../../index/index_adm.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>
            <?php
            
            
            include("../../database/database.php");

            $clientes = new Database();
            $listado = $clientes->read();

            if (isset($_POST) && !empty($_POST)) {
                $usr_nombre = $clientes->sanitize($_POST['USRNOMBRE']);
                $usr_clave = $clientes->sanitize($_POST['USRCLAVE']);
                $usr_log = $clientes->sanitize($_POST['USRLOG']);
                $usr_id = $clientes->sanitize($_POST['tipo_id']);

                $res = $clientes->create_usr($usr_nombre, $usr_clave,$usr_id, $usr_log);
                if ($res) {
                    $message = "Usuario creado con exito";
                    $class = "alert alert-success";
                } else {
                    $message = "No se pudiero crear el usuario";
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
                                            <label>ID/Correo:</label>
                                            <input type="text" name="USRNOMBRE" id="nombres" class="form-control"
                                                maxlength="100" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contraseña:</label>
                                            <input type="text" name="USRCLAVE" id="clave" class="form-control" maxlength="8"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>¿Como quiere que se llame?:</label>
                                            <input type="text" name="USRLOG" id="log" class="form-control"
                                                maxlength="100" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label>ADMINISTRACION DE CUENTA:</label>
                                            <select class="form-control" name="tipo_id">
                                                <option id=1 value="1">Admin</option>
                                                <option id=2 value="2" selected>Usuario</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pull-right">
                                            <br>
                                            <button type="submit" class="btn btn-success">Guardar datos</button>
                                        </div>
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