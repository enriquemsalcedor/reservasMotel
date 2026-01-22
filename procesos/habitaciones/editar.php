<?php
require_once '../../clases/Habitacion.php';
require_once '../../clases/Conexion.php';
$txtnumero = $_POST['txtnumero'];
$txtprecio = $_POST['txtprecio'];
$txtdescripcion = $_POST['txtdescripcion'];
$txtpreciohora = $_POST['txtpreciohora'];
$txtestadohabitacion = $_POST['txtestadohabitacion'];
$txttipohabitacion = $_POST['txttipohabitacion'];
$txtestatus = $_POST['txtestatus'];
$datos = array($id,$txtnumero,$txtdescripcion,$txtprecio,$txtpreciohora,$txtestadohabitacion,$txttipohabitacion,$txtestatus);
$obj = new Habitacion();
echo $obj->edit($datos);
?>