<?php
require_once '../../clases/Habitacion.php';
require_once '../../clases/Conexion.php';
$id = $_POST['id'];
$obj = new Habitacion();
echo $obj->delete($id);
?>