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
        case "diasSemana":
                diasSemana();
                break;
        case "resevasSemana":
                resevasSemana();
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
            SELECT 'Reservada' as name, count(*) as y, (SELECT color FROM estado_habitacion WHERE id = 1) as color
            FROM habitacion 
            WHERE id_estado_habitacion = 1 AND estatus = 'A'
            UNION
            SELECT 'Disponible' as name, count(*) as y, (SELECT color FROM estado_habitacion WHERE id = 2) as color
            FROM habitacion 
            WHERE id_estado_habitacion = 2 AND estatus = 'A'
            UNION
            SELECT 'Mantenimiento' as name, count(*) as y, (SELECT color FROM estado_habitacion WHERE id = 4) as color
            FROM habitacion 
            WHERE id_estado_habitacion = 4 AND estatus = 'A'
            
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

    function diasSemana(){
        global $mysqli;
        $sql = "SELECT 
            DATE_FORMAT(
            DATE_ADD(
                DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), 
                INTERVAL seq DAY
            ) , '%d/%m/%Y') 
            AS fecha
        FROM (
            SELECT 0 AS seq UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL 
            SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
        ) AS dias";
        $result = $mysqli->query($sql);
        while($row = $result->fetch_assoc()){
			$registros[] 	= array(
				'dias' 	=> $row['fecha'],
				
			);
		}

        echo json_encode($registros);

    }

    function resevasSemana(){
        global $mysqli;
        $fechas = $_REQUEST['fechas'];
        $resultado = array();
        foreach ($fechas as $value) {
            $sql ="SELECT count(*) as cant FROM reservacion WHERE DATE_FORMAT(fecha_reserva, '%d/%m/%Y') = '$value'";
            $result = $mysqli->query($sql);
            
            while($row = $result->fetch_assoc()){
                $resultado[] 	= array(
                    'value' 	=> $row['cant'],
                );
            }

        }
        echo json_encode($resultado);


    }



    