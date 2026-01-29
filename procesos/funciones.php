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
        case "reporteEstados":
                reporteEstados();
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
        $result = $mysqli->query($sql);
		$tabla = '';
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
        if($mysqli->query($sql)){
            echo 1;      
        }else{
            echo 0;
        }  
        
    }

    function reporteEstados(){
        global $mysqli;
        $sql = "
            SELECT 'Reservada' as name, count(r.id_habitacion) as y, e.color
            FROM reservacion r 
            LEFT JOIN habitacion h ON h.id = r.id_habitacion
            LEFT JOIN estado_habitacion e ON e.id = h.id_estado_habitacion
            WHERE h.id_estado_habitacion = 1
            UNION
            SELECT 'Disponible' as name, count(r.id_habitacion) as y, e.color
            FROM reservacion r 
            LEFT JOIN habitacion h ON h.id = r.id_habitacion 
            LEFT JOIN estado_habitacion e ON e.id = h.id_estado_habitacion
            WHERE h.id_estado_habitacion = 2
            UNION
            SELECT 'Disponible' as name, count(r.id_habitacion) as y, e.color
            FROM reservacion r 
            LEFT JOIN habitacion h ON h.id = r.id_habitacion 
            LEFT JOIN estado_habitacion e ON e.id = h.id_estado_habitacion
            WHERE h.id_estado_habitacion = 4
            
            ";
        $result = $mysqli->query($sql);
        while($row = $result->fetch_assoc()){
			$registros[] 	= array(
				'name' 	=> $row['name'],
				'y' 	=> $row['y'],
                'color' => $row['color']
			);
		}

        echo json_encode($registros);

    }



    