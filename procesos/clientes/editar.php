<?php
require_once '../../clases/Cliente.php';
require_once '../../clases/Conexion.php';
$id = $_POST['id'];
$txtnombre = $_POST['txtnombre'];
$txtapellido = $_POST['txtapellido'];
$txtcedula = $_POST['txtcedula'];
$txttelefono = $_POST['txttelefono'];
$txtdireccion = $_POST['$txtdireccion'];

$datos = array($id,$txtcedula,$txtnombre,$txtapellido,$txttelefono,$txtdireccion);
$obj = new Cliente();
echo $obj->edit($datos);
?>