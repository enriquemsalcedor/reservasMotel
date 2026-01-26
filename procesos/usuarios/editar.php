<?php
require_once '../../clases/Usuario.php';
require_once '../../clases/Conexion.php';

$clave = $_POST['txtclave'];
$tipousuario = $_POST['txttipousuario'];
$estatus = $_POST['txtestatus'];

$id = $_POST['id'];

$datos = array($id,$clave,$tipousuario,$estatus);
$obj = new Usuario();
echo $obj->edit($datos);
?>