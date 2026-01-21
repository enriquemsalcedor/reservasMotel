<?php
require_once '../../clases/Categoria.php';
require_once '../../clases/Conexion.php';
$nombre = $_POST['txtnombre'];
$obj = new TipoHabitacion();
echo $obj->save($nombre);
?>