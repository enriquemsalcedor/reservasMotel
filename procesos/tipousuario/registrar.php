<?php
require_once '../../clases/TipoUsuario.php';
require_once '../../clases/Conexion.php';
$nombre = $_POST['txtnombre'];
$obj = new TipoUsuario();
echo $obj->save($nombre);
?>