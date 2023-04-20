<?php
class Database
{
  private $con;
  private $dbhost = "localhost";
  private $dbuser = "root";
  private $dbpass = "";
  private $dbname = "comput_house";

  function __construct()
  {
    $this->connect_db();
  }
  public function connect_db()
  {
    $this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
    if (mysqli_connect_error()) {
      die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
    }
  }
  public function sanitize($var)
  {
    $return = mysqli_real_escape_string($this->con, $var);
    return $return;
  }

  public function create($dni, $nombres, $apellidop, $apellidom, $cel, $clidescripcion, $cliestado, $usuario_id)
  {
    $sql = "INSERT INTO `CLIENTES` (CLIDNI, CLINOMBRE, CLIAPELLIDOP, CLIAPELLIDOM, CLICEL , CLIDESCRIPCION, CLISTADO, usuario_id) VALUES ('$dni', '$nombres', '$apellidop', '$apellidom', '$cel', '$clidescripcion','$cliestado','$usuario_id')";
    $res = mysqli_query($this->con, $sql);
    if ($res) {
      return true;
    } else {
      return false;
    }
  }

  public function create_usr($usr_nombre, $usr_clave, $usr_id, $usr_log)
  {
    $sql = "INSERT INTO `USUARIO` (USRNOMBRE, USRCLAVE, tipo_id, USRLOG) VALUES ('$usr_nombre', '$usr_clave','$usr_id','$usr_log')";
    $res = mysqli_query($this->con, $sql);
    if ($res) {
      return true;
    } else {
      return false;
    }
  }

  public function read()
  {
    $sql = "SELECT * FROM CLIENTES JOIN ESTADO ON CLIENTES.CLISTADO = ESTADO.ID_ESTADO join usuario on clientes.usuario_id = usuario.USRID;";
    $res = mysqli_query($this->con, $sql);
    return $res;
  }

  public function single_record($id)
  {
    $sql = "SELECT * FROM clientes JOIN ESTADO ON CLIENTES.CLISTADO = ESTADO.ID_ESTADO where CLIID='$id;'";
    $res = mysqli_query($this->con, $sql);
    $return = mysqli_fetch_object($res);
    return $return;
  }

  public function update($dni, $nombres, $apellidop, $apellidom, $clidescripcion, $cel, $cliestado, $id)
  {

    $sql = "UPDATE clientes SET CLIDNI ='$dni',  CLINOMBRE='$nombres', CLIAPELLIDOP='$apellidop' , CLIAPELLIDOM= '$apellidom', CLICEL='$cel', CLIDESCRIPCION ='$clidescripcion', CLISTADO='$cliestado' WHERE CLIID=$id";
    $res = mysqli_query($this->con, $sql);
    if ($res) {
      return true;
    } else {
      return false;
    }
  }
  public function delete($id)
  {
    $sql = "DELETE FROM clientes WHERE CLIID=$id";

    $res = mysqli_query($this->con, $sql);
    if ($res) {
      return true;
    } else {
      return false;
    }
  }

  public function usr_read($usr)
  {
    $sql = "SELECT * FROM usuario where USRNOMBRE= '$usr'";
    $res = mysqli_query($this->con, $sql);
    return $res;
  }

  public function KARANMANDUNKA($id)
  {

  }
}
?>