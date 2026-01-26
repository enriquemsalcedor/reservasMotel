<?php
require_once '../../clases/Cliente.php';
require_once '../../clases/Conexion.php';
$id = $_GET['id'];
$obj = new Cliente();
echo json_encode($obj->traer($id));
?>