<?php
require_once '../../clases/Reserva.php';
require_once '../../clases/Conexion.php';
$id = $_GET['id'];
$obj = new Reserva();
echo json_encode($obj->traer($id));
?>