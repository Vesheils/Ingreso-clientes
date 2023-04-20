<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    header("location:index.php");
}
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
    <title>Actualizar usario</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/create.css">
</head>

<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8">
                        <h2><b>Editar Cliente</b></h2>
                    </div>
                    <div class="col-sm-4">
                        <a href="../index/index_adm.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>
            <?php

            include("../database/database.php");
            $clientes = new Database();
            $res = null;
            $message = '';
            $listado = $clientes->read();
            $row = mysqli_fetch_object($listado);
            $DE_ESTADO = $row->DES_ESTADO;
            $owner= $row->USRLOG;

            if (isset($_POST) && !empty($_POST)) {
                $dni = $clientes->sanitize($_POST['CLIDNI']);
                $nombres = $clientes->sanitize($_POST['CLINOMBRE']);
                $apellidop = $clientes->sanitize($_POST['CLIAPELLIDOP']);
                $apellidom = $clientes->sanitize($_POST['CLIAPELLIDOM']);
                $cel = $clientes->sanitize($_POST['CLICEL']);
                $descripcion = $clientes->sanitize($_POST['CLIDESCRIPCION']);
                $estado = $clientes->sanitize($_POST['CLISTADO']);
                $id_cliente = intval($_POST['id_cliente']);
                


                
                $res = $clientes->update($dni, $nombres, $apellidop,$apellidom ,$descripcion , $cel, $estado, $id_cliente,);
                }
                if ($res === true) {
                    $message = "Datos actualizados con éxito";
                    $class = "alert alert-success";
                } elseif ($res === false) {
                    $message = "No se pudieron actualizar los datos";
                    $class = "alert alert-danger";
                }

                ?>
                <div class="<?php echo $class ?>">
                    <?php echo $message; ?>
                </div>
                <?php
            
            $datos_cliente = $clientes->single_record($id);
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-container">
                        <div class="row">
                            <form method="post">
                                <div class="col-md-6">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombres:</label>
                                        <input type="text" name="CLINOMBRE" id="nombres" class="form-control"
                                            maxlength="100" required value="<?php echo $datos_cliente->CLINOMBRE; ?>">
                                        <input type="hidden" name="id_cliente" id="id_cliente" class='form-control'
                                            maxlength="100" value="<?php echo $datos_cliente->CLIID; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>DNI:</label>
                                        <input type="text" name="CLIDNI" id="dni" class="form-control"
                                            maxlength="8" required value="<?php echo $datos_cliente->CLIDNI; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Apellido Paterno:</label>
                                        <input type="text" name="CLIAPELLIDOP" id="apellidop" class="form-control"
                                            maxlength="100" required value="<?php echo $datos_cliente->CLIAPELLIDOP; ?>">
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"> </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Apellido Materno:</label>
                                    <input type="text" name="CLIAPELLIDOM" id="apellidom" class="form-control"
                                        maxlength="100" value="<?php echo $datos_cliente->CLIAPELLIDOM; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <label>¿Algo que comentar?:</label>
                                    <textarea name="CLIDESCRIPCION" id="descripcion" class='form-control'
                                        maxlength="500"><?php echo $datos_cliente->CLIDESCRIPCION; ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Teléfono:</label>
                                    <input type="text" name="CLICEL" id="cel" class="form-control" maxlength="9"
                                         value="<?php echo $datos_cliente->CLICEL; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estado:</label>

                                    <select class="form-control" name="CLISTADO"> 
                                            <option id=1 value="1"<?php if ($datos_cliente->CLISTADO  == '1') echo 'selected';?>> Pendiente</option>
                                            <option id=2 value="2"<?php if ($datos_cliente->CLISTADO  == '2') echo 'selected';?>> Entregado</option>
                                            
                                    </select>
                                    <div class="col-md-12 pull-right">
                                        <br>  
                                        <button type="submit" class="btn btn-success">Actualizar datos</button>
                                        
                                    </div>
                                    </form>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>