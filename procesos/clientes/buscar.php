<?php
require_once '../../clases/Cliente.php';
require_once '../../clases/Conexion.php';
$cedula = $_POST['cedula'];
$obj = new Cliente();
echo json_encode($obj->buscar($cedula));
?>