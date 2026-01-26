<?php
require_once '../../clases/Usuario.php';
require_once '../../clases/Conexion.php';
$usuario = $_POST['txtusuario'];
$clave = $_POST['txtclave'];
$tipousuario = $_POST['txttipousuario'];

$datos = array($usuario,$clave,$tipousuario);

$obj = new Usuario();
echo $obj->save($datos);
?>