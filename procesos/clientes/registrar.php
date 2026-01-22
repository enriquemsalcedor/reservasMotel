<?php
require_once '../../clases/Cliente.php';
require_once '../../clases/Conexion.php';

$txtnombre = $_POST['txtnombre'];
$txtapellido = $_POST['txtapellido'];
$txtcedula = $_POST['txtcedula'];
$txttelefono = $_POST['txttelefono'];
$txtdireccion = $_POST['$txtdireccion'];

$datos = array($txtcedula,$txtnombre,$txtapellido,$txttelefono,$txtdireccion);
$obj = new Cliente();
echo $obj->save($datos);
?>