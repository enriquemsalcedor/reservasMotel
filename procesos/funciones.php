<?php

    include("../procesos/conexion.php");

	$accion = '';
	if (isset($_REQUEST['accion'])) {
		$accion = $_REQUEST['accion'];   
	}
    session_start();
	
	switch($accion){
		case "existUsuario": 
              existUsuario();
			  break;
        case "existCliente":
                existCliente();
                break;	
        case "respaldos":
                respaldos();
                break;
        case "aggrespaldos":
                aggrespaldos();
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

    function respaldos(){
        global $mysqli;

       	$sql = "select * from respaldo order by id desc";
		
        $tabla .= '
                <thead>
                    <tr>
                        <td>Usuario</td>
                        <td>Fecha</td>
                        
                    </tr>
                </thead>
                ';
        while($row = $result->fetch_assoc()){

            $tabla .= '
                    <tr>
                        <td>'.$row['usuario'].'</td>
                        <td>'.$row['fecha'].'</td>
                        
                    </tr>
                        
                    ';
        
        }
            
        echo $tabla;
        
    }

    function aggrespaldos(){

       	global $mysqli;
        $usuario = $_SESSION['usuario'];
        $sql = "INSERT INTO respaldo (usuario, fecha) VALUES ('$usuario', NOW())";
        mysqli->query($sql);
            echo 1;        
        
    }



    