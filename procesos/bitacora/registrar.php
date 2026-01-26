<?php
require_once '../../clases/Bitacora.php';
require_once '../../clases/Conexion.php';

$usuario = $_POST['usuario'];
$accion = $_POST['accion'];
$modulo = $_POST['modulo'];

$datos = array($usuario,$accion,$modulo);
$obj = new Bitacora();
echo $obj->save($datos);
?>