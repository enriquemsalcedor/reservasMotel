<?php
require_once '../../clases/Habitacion.php';
require_once '../../clases/Conexion.php';
$txtnumero = $_POST['txtnumero'];
$txtprecio = $_POST['txtprecio'];
$txtdescripcion = $_POST['txtdescripcion'];
$txtpreciohora = $_POST['txtpreciohora'];
$txtestadohabitacion = $_POST['txtestadohabitacion'];
$txttipohabitacion = $_POST['txttipohabitacion'];

$datos = array($txtnumero,$txtdescripcion,$txtprecio,$txtpreciohora,$txtestadohabitacion,$txttipohabitacion);
$obj = new Habitacion();
echo $obj->save($datos);
?>