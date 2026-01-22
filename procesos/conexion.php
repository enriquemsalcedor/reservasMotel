<?php
    $mysqli = new mysqli("localhost", "root", "", "motel", "3306");

    if ($mysqli->connect_error) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_error . ") " . $mysqli->connect_error;
}


?>