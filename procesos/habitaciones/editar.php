<?php
require_once '../../clases/Habitacion.php';
require_once '../../clases/Conexion.php';

$id = $_POST['id'];
$txtnumero = $_POST['txtnumero'];
$txtprecio = $_POST['txtprecio'];
$txtdescripcion = $_POST['txtdescripcion'];
$txtpreciohora = $_POST['txtpreciohora'];
$txtestadohabitacion = $_POST['txtestadohabitacion'];
$txttipohabitacion = $_POST['txttipohabitacion'];
$txtestatus = $_POST['txtestatus'];
$txtmaxpersona = $_POST['txtmaxpersona'];

$datos = array($id,$txtnumero,$txtdescripcion,$txtprecio,$txtpreciohora,$txtestadohabitacion,$txttipohabitacion,$txtestatus,$txtmaxpersona);
$obj = new Habitacion();
echo $obj->edit($datos);
?>