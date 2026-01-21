<?php
require_once '../../clases/EstadoHabitacion.php';
require_once '../../clases/Conexion.php';
$id = $_POST['id'];
$obj = new EstadoHabitacion();
echo $obj->delete($id);
?>