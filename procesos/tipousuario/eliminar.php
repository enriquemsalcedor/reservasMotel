<?php
require_once '../../clases/TipoUsuario.php';
require_once '../../clases/Conexion.php';
$id = $_POST['id'];
$obj = new TipoUsuario();
echo $obj->delete($id);
?>