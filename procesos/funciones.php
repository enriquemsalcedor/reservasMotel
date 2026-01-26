<?php

    include("../procesos/conexion.php");

	$accion = '';
	if (isset($_REQUEST['accion'])) {
		$accion = $_REQUEST['accion'];   
	}
	
	switch($accion){
		case "existUsuario": 
              existUsuario();
			  break;
        case "existCliente":
                existCliente();
                break;	
		default:
			  echo "{failure:true}";
			  break;
	}

    function existUsuario(){
        global $mysqli;

        $usuario = $_REQUEST['usuario'];
       	$sql = "select * from usuario where usuario = '$usuario'";
        $result = $mysqli->query($sql);
		echo $result->num_rows;
        
    }

    function existCliente(){
        global $mysqli;

        $cedula = $_REQUEST['cedula'];
        $tipo = $_REQUEST['tipo'];
       	$sql = "select * from cliente where cedula = '$cedula' and tipo_cliente = '$tipo'";
        $result = $mysqli->query($sql);
		echo $result->num_rows;
        
    }


    