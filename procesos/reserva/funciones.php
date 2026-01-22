<?php

    include("../../procesos/conexion.php");

	$accion = '';
	if (isset($_REQUEST['accion'])) {
		$accion = $_REQUEST['accion'];   
	}
	
	switch($accion){
		case "save": 
              save();
			  break;
        case "habitaciones":
                habitaciones();
                break;
		
		default:
			  echo "{failure:true}";
			  break;
	}

    function save(){
        global $mysqli;

        $id_habitacion = $_REQUEST['id_habitacion'];
        $id_cliente	= (!empty($_REQUEST['id_cliente']) ? $_REQUEST['id_cliente'] : 0);

        $tipo_reserva = $_REQUEST['tipo_reserva'];
        $horas = $_REQUEST['horas'];
        $fechai = $_REQUEST['fechai'];
        $fechac = $_REQUEST['fechac'];
        $total = $_REQUEST['total']; 

        $cedula = (!empty($_REQUEST['cedula']) ? $_REQUEST['cedula'] : 0); 
        $nombre = (!empty($_REQUEST['nombre']) ? $_REQUEST['nombre'] : 0);
        $apellido = (!empty($_REQUEST['apellido']) ? $_REQUEST['apellido'] : 0); 
        $telefono = (!empty($_REQUEST['telefono']) ? $_REQUEST['telefono'] : 0);
        $direccion = (!empty($_REQUEST['direccion']) ? $_REQUEST['direccion'] : 0);

        if($id_cliente == 0){

            $sql = "INSERT INTO cliente (cedula, nombre, apellido, telefono, direccion, estatus) VALUES
                        ('$cedula', '$nombre', '$apellido', '$telefono', '$direccion', 'A')";
           if($mysqli->query($sql)){
                $id_cliente = $mysqli->insert_id;
                $sql = "INSERT INTO reservacion ( id_cliente, id_habitacion, fecha_actual, fecha_reserva, fecha_finalizacion, precio_total, estatus) 
                    VALUES ($id_cliente, $id_habitacion, NOW(), '$fechai', '$fechac', $total, 'A')";
                $result = $mysqli->query($sql);
		        $reserva = $mysqli->insert_id;
                
                if($result == true){

                    updateReservaHabitacion($id_habitacion);
                }
                $response = array(			
                    "codigo" => 'OK',
                    "reservacion" => $reserva,
                );
                echo json_encode($response);
           }       

        }else{
            $sql = "INSERT INTO reservacion ( id_cliente, id_habitacion, fecha_actual, fecha_reserva, fecha_finalizacion, precio_total, estatus) 
                VALUES ($id_cliente, $id_habitacion, NOW(), '$fechai', '$fechac', $total, 'A')";
            $result = $mysqli->query($sql);
		    $reserva = $mysqli->insert_id;
                
            if($result == true){
                updateReservaHabitacion($id_habitacion);
            }
            
            $response = array(			
                "codigo" => 'OK',
                "reservacion" => $reserva,
            );
		    
            echo json_encode($response);
        }
    }

    function updateReservaHabitacion($id){
        global $mysqli;
        $sql = "update habitacion set id_estado_habitacion = 1 where id=$id";
        echo $sql;
        $mysqli->query($sql);

    }

    function habitaciones(){
        global $mysqli;

        $estado = $_REQUEST['estado'];
        $tipo = $_REQUEST['tipo'];

        $sql = "SELECT h.numero, h.precio, e.nombre as estado, e.color, t.nombre as tipo_habitacion, h.id
                FROM habitacion h 
				JOIN tipo_habitacion t ON h.id_tipo_habitacion = t.id 
				JOIN estado_habitacion e ON h.id_estado_habitacion = e.id
                WHERE h.estatus <> 'E'";


        if($estado != 0){
            $sql .= " AND id_estado_habitacion = $estado ";
        }

        if($tipo != 0){
            $sql .= " AND id_tipo_habitacion = $tipo ";
        }
        

        $result = $mysqli->query($sql);
        $cards = '';
        while($row = $result->fetch_assoc()){

            $cards .= '
                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card-box noradius noborder" style="height: 310px; background-color:'.$row['color'].'">
                                <div style="display:flex;">
                                    <i class="fa fa-bed  float-right"></i>
                                </div>
                                <div style="text-align: right;">
                                    <h4 class="text-uppercase m-b-20">#'.$row['numero'].'</h4>
                                    <label class="">'.$row['tipo_habitacion'].'</label><br>
                                    <label class="text-uppercase m-b-20">$'. number_format($row['precio'], 2, ',', ' ').'</label><br>
                                </div>
                                ';
                                
                                if ($row['estado'] == "Disponible"){
                                    $cards .='
                                        <div style="text-align: center;">
                                            <button id="'.$row['id'].'" value="'.$row['estado'].'" style="background:'.$row['color'].'"
                                            class="pill" data-toggle="modal" data-target="#exampleModalLabel" 
                                            type="button" >'.$row['estado'].'</button>
                                        </div> ';
                                }else if ($row['estado'] == "Reservada"){
                                    $cards .='
                                        <div style="text-align: center;">
                                            <button id="'.$row['id'].'" value="'.$row['estado'].'" style="background:'.$row['color'].'"
                                            class="pill reservada" data-toggle="modal" data-target="#modalReservado" 
                                            type="button" >'.$row['estado'].'</button>
                                        </div> ';
                                }else{
                                    $cards .='
                                        <div style="text-align: center;">
                                            <button value="'.$row['estado'].'" style="background:'.$row['color'].'"
                                            class="pill nonreserva" type="button" >'.$row['estado'].'</button>
                                        </div>';
                                }
                                        
                            $cards .='</div>
                        </div>
                    ';
        
        }
            
        echo $cards;


    }