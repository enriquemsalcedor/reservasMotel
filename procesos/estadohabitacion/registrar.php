<?php
require_once '../../clases/EstadoHabitacion.php';
require_once '../../clases/Conexion.php';
$nombre = $_POST['txtnombre'];
$obj = new EstadoHabitacion();
echo $obj->save($nombre);
?>