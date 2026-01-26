<?php
require_once '../../clases/Vehiculo.php';
require_once '../../clases/Conexion.php';

$cliente = $_POST['cliente'];
$placa = $_POST['placa'];
$modelo = $_POST['modelo'];
$sesion = $_POST['sesion'];

$datos = array($cliente,$placa,$modelo,$sesion);
$obj = new Vehiculo();
echo $obj->save($datos);

?>