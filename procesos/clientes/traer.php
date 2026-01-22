<?php
require_once '../../clases/Habitacion.php';
require_once '../../clases/Conexion.php';
$id = $_GET['id'];
$obj = new Habitacion();
echo json_encode($obj->traer($id));
?>