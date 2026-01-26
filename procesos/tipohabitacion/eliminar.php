<?php
require_once '../../clases/TipoHabitacion.php';
require_once '../../clases/Conexion.php';
$id = $_POST['id'];
$obj = new TipoHabitacion();
echo $obj->delete($id);
?>