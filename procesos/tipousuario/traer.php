<?php
require_once '../../clases/TipoUsuario.php';
require_once '../../clases/Conexion.php';
$id = $_GET['id'];
$obj = new TipoUsuario();
echo json_encode($obj->traer($id));
?>