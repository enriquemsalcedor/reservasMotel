<?php
require_once '../../clases/Cliente.php';
require_once '../../clases/Conexion.php';
$id = $_POST['id'];

$txttipocliente = $_POST['txttipocliente'];
$txtnombre = $_POST['txtnombre'];
$txtapellido = $_POST['txtapellido'];
$txtcedula = $_POST['txtcedula'];
$txttelefono = $_POST['txttelefono'];
$txtdireccion = $_POST['txtdireccion'];
$txtestatus = $_POST['txtestatus'];

$datos = array($id,$txttipocliente,$txtcedula,$txtnombre,$txtapellido,$txttelefono,$txtdireccion,$txtestatus);
$obj = new Cliente();
echo $obj->edit($datos);
?>