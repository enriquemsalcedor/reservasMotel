<?php
require_once '../../clases/TipoUsuario.php';
require_once '../../clases/Conexion.php';

$nombre = $_POST['txtnom'];
$id = $_POST['id'];
$datos = array($id,$nombre);
$obj = new TipoUsuario();
echo $obj->edit($datos);
?>