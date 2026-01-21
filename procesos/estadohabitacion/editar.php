<?php
require_once '../../clases/EstadoHabitacion.php';
require_once '../../clases/Conexion.php';

$nombre = $_POST['txtnom'];
$color = $_POST['txtcolor'];
$id = $_POST['id'];
$datos = array($id,$nombre,$color);
$obj = new EstadoHabitacion();
echo $obj->edit($datos);
?>