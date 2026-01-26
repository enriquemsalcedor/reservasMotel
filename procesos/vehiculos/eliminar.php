<?php
require_once '../../clases/Vehiculo.php';
require_once '../../clases/Conexion.php';
$id = $_POST['id'];
$obj = new Vehiculo();
echo $obj->delete($id);
?>