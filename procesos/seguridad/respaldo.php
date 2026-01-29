<?php
// Configuración
session_start();
$usuario = $_SESSION['usuario'];

$host = 'localhost';
$user = 'root';
$pass = '';
$name = 'motel';
$fecha = date("Ymd-His");

// Nombre del archivo de salida
$salida = "respaldo_{$name}_{$fecha}.sql";

// Comando para ejecutar mysqldump
// Nota: Asegúrate de que 'mysqldump' esté en el PATH de tu servidor
$comando = "mysqldump --opt -h $host -u $user -p$pass $name > $salida";

system($comando, $resultado);

if ($resultado === 0) {
     
} else {
    echo "Hubo un error al crear el respaldo.";
}

?>