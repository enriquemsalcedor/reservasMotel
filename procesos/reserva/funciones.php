<?php

    include("../../procesos/conexion.php");

	$accion = '';
	if (isset($_REQUEST['accion'])) {
		$accion = $_REQUEST['accion'];   
	}
	session_start();
	switch($accion){
		case "save": 
              save();
			  break;
        case "habitaciones":
                habitaciones();
                break;
        case "reservaDia":
                reservaDia();
                break;
        case "finalizarReserva":
                finalizarReserva();
                break;	
        case "reporte":
            reporte();
            break;
        case "acompa":
            acompa();
            break;
        case "addAcomp":
            addAcomp();
            break;
        case "reporte_clientes":
            reporte_clientes();
            break;
        case "deleteAcomp":
            deleteAcomp();
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

        $usuario = $_SESSION['usuario'];

        if($id_cliente == 0){

            $sql = "INSERT INTO cliente (cedula, nombre, apellido, telefono, direccion, estatus) VALUES
                        ('$cedula', '$nombre', '$apellido', '$telefono', '$direccion', 'A')";
           if($mysqli->query($sql)){
                $id_cliente = $mysqli->insert_id;
                
                $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se creo el cliente #$id_cliente','Reserva',Now())";
                mysqli_query($conexion,$sqlx);
            
                $sql = "INSERT INTO reservacion ( id_cliente, id_habitacion, fecha_actual, fecha_reserva, fecha_finalizacion, precio_total, estatus, tipo_reserva) 
                    VALUES ($id_cliente, $id_habitacion, NOW(), '$fechai', '$fechac', $total, 'A', '$tipo_reserva')";
                $result = $mysqli->query($sql);
		        $reserva = $mysqli->insert_id;
                $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se creo la reserva #$reserva','Reserva',Now())";
                mysqli_query($conexion,$sqlx);
                
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
            $sql = "INSERT INTO reservacion ( id_cliente, id_habitacion, fecha_actual, fecha_reserva, fecha_finalizacion, precio_total, estatus, tipo_reserva) 
                VALUES ($id_cliente, $id_habitacion, NOW(), '$fechai', '$fechac', $total, 'A', '$tipo_reserva')";
            $result = $mysqli->query($sql);
            $reserva = $mysqli->insert_id;
            $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se creo la reserva #$reserva','Reserva',Now())";
            $mysqli->query($sqlx); 

            if($result == true){
                updateReservaHabitacion($id_habitacion);
                $usuario = $_SESSION['usuario'];
                $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se creo la reserva #$reserva','Reserva',Now())";
                $mysqli->query($sqlx); 
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
        $mysqli->query($sql);
        $usuario = $_SESSION['usuario'];
                $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se edito estado de la habitacion #$id','Reserva',Now())";
                $mysqli->query($sqlx); 

    }

    function habitaciones(){
        global $mysqli;

        $estado = $_REQUEST['estado'];
        $tipo = $_REQUEST['tipo'];
        $dolar = $_REQUEST['dolar'];

        $sql = "SELECT h.numero, h.precio, e.nombre as estado, e.color, t.nombre as tipo_habitacion, h.id, h.id_tipo_habitacion
                FROM habitacion h 
				JOIN tipo_habitacion t ON h.id_tipo_habitacion = t.id 
				JOIN estado_habitacion e ON h.id_estado_habitacion = e.id
                WHERE h.estatus <> 'E'";

        if($estado != 0){
            $sql .= " AND h.id_estado_habitacion = $estado ";
        }

        if($tipo != 0){
            $sql .= " AND h.id_tipo_habitacion = $tipo ";
        }
        

        $result = $mysqli->query($sql);
        $cards = '';
        while($row = $result->fetch_assoc()){
            $img = '';
            if($row['id_tipo_habitacion'] == 1){
                $img = '../assets/images/jacuzzi.png';
            }else if($row['id_tipo_habitacion'] == 2){
                $img = '../assets/images/aereo.png';
            }else if($row['id_tipo_habitacion'] == 3){
                $img = '../assets/images/clasica.png';
            }else{
                $img = '../assets/images/clasica.png';
            }

            $cards .= '
                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card-box noradius noborder" style="height: 310px; border-radius: 20px; background-color:'.$row['color'].'">
                                <div style="display:flex;">
                                    <img src="'.$img.'" alt="" style="width: 50%;">
                                </div>
                                <div style="text-align: right;">
                                    <h4 class="text-uppercase m-b-20">#'.$row['numero'].'</h4>
                                    <label class="">'.$row['tipo_habitacion'].'</label><br>
                                    <label class="text-uppercase m-b-20">'. number_format($row['precio'] * $dolar, 2, ',', ' ').' Bs.</label><br>
                                </div>
                                ';
                                
                                if ($row['estado'] == "Disponible"){
                                    $cards .='
                                        <div style="text-align: center;">
                                            <button id="'.$row['id'].'" value="'.$row['estado'].'" style="background:'.$row['color'].'"
                                            class="pill disponible" data-toggle="modal" data-target="#exampleModalLabel" 
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

    function reservaDia(){

        global $mysqli;
        $fecha = date('d/m/Y');
        $tabla = '';       

        $sql = "SELECT h.numero, CONCAT(c.nombre,' ',c.apellido) AS cliente, c.telefono, r.id AS reserva,
                DATE_FORMAT(fecha_reserva, '%d/%m/%Y') as fecha_reserva, h.id AS habitacion,
                DATE_FORMAT(fecha_finalizacion, '%d/%m/%Y') as fecha_finalizacion 
                FROM habitacion h 
                 JOIN reservacion r ON r.id_habitacion = h.id 
                 JOIN cliente c ON c.id = r.id_cliente
                WHERE DATE_FORMAT(fecha_reserva, '%d/%m/%Y') = '$fecha' AND r.estatus <>'F'";
        //echo $sql;
        $result = $mysqli->query($sql);
        $num = 1;
        $tabla .= '
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Habitación</td>
                        <td>Cliente</td>
                        <td>Telefono</td>
                        <td>Fecha Inicio</td>
                        <td>Fecha Fin</td>
                        <td></td>
                        
                    </tr>
                </thead>
                ';
        while($row = $result->fetch_assoc()){
            $tabla .= '
                    <tr>
                        <td>'.$num.'</td>
						<td>'.$row['numero'].'</td>
                        <td>'.$row['cliente'].'</td>
                        <td>'.$row['telefono'].'</td>
                        <td>'.$row['fecha_reserva'].'</td>
                        <td>'.$row['fecha_finalizacion'].'</td>
                        <td>
                            <button type="button" class="btn btn-primary fa fa-file-pdf-o" onclick="imprimirPDF('.$row['reserva'].')"></button>
                            <button type="button" class="btn btn-warning fa fa-clock-o" onclick="finalizar('.$row['reserva'].','.$row['habitacion'].')"></button>
                        </td>                    
					</tr>';
            $num++;
        }

        echo $tabla;

    }

    function finalizarReserva(){
        global $mysqli;

        $habitacion = $_REQUEST['habitacion'];
        $reserva = $_REQUEST['reserva'];
        
        $sql1 = "update habitacion set id_estado_habitacion = 2 where id=$habitacion";
        $mysqli->query($sql1);
        $sql2 = "update reservacion set estatus = 'F' where id=$reserva";
        $mysqli->query($sql2);

        echo 1;

    }

    function reporte(){
        global $mysqli;

        $tiporeserva = $_REQUEST['tiporeserva'];
        $tipo = $_REQUEST['tipo'];

        $fechai = $_REQUEST['fechai'];
        $fechaf = $_REQUEST['fechaf'];

        $sql = "SELECT CONCAT(c.nombre, ' ', c.apellido) as cliente, CONCAT(c.tipo_cliente, c.cedula) as cedula, 
                h.numero, t.nombre as tipohabitacion, r.precio_total, r.tipo_reserva, v.placa, v.modelo,
                DATE_FORMAT(r.fecha_reserva, '%d/%m/%Y') as fecha_reserva, 
                DATE_FORMAT(r.fecha_finalizacion, '%d/%m/%Y') as fecha_finalizacion
                FROM reservacion r
                JOIN cliente c ON c.id = r.id_cliente
                LEFT JOIN vehiculo v ON v.id = c.id
                JOIN habitacion h ON h.id = r.id_habitacion
                JOIN tipo_habitacion t ON t.id = h.id_tipo_habitacion";


        if($tiporeserva != 0){
            $sql .= " AND r.tipo_reserva = $tiporeserva ";
        }

        if($tipo != 0){
            $sql .= " AND h.id_tipo_habitacion = $tipo ";
        }

        if($fechai != '' && $fechaf != ''){
            $sql .= " AND (DATE_FORMAT(r.fecha_reserva, '%d/%m/%Y') BETWEEN DATE_FORMAT('$fechai', '%d/%m/%Y') AND DATE_FORMAT('$fechaf', '%d/%m/%Y'))";
        }


        $result = $mysqli->query($sql);
        $tabla = '';
        $tabla .= '
                <thead>
                    <tr>
                        <td>Cedula</td>
                        <td>Cliente</td>
                        <td>Habitacion</td>
                        <td>Tipo</td>
                        <td>Precio</td>
                        <td>Tipo reserva</td>
                        <td>Placa vehiculo</td>
                        <td>Modelo vehiculo</td>
                        <td>Fecha Inicio</td>
                        <td>Fecha Fin</td>
                        
                    </tr>
                </thead>
                ';
        while($row = $result->fetch_assoc()){

            $tabla .= '
                    <tr>
                        <td>'.$row['cedula'].'</td>
                        <td>'.$row['cliente'].'</td>
                        <td>'.$row['numero'].'</td>
                        <td>'.$row['tipohabitacion'].'</td>
                        <td>'.$row['precio_total'].'</td>
                        <td>'.$row['tipo_reserva'].'</td>
                        <td>'.$row['placa'].'</td>
                        <td>'.$row['modelo'].'</td>
                        <td>'.$row['fecha_reserva'].'</td>
                        <td>'.$row['fecha_finalizacion'].'</td>
                    </tr>
                        
                    ';
        
        }
            
        echo $tabla;

    }

    function acompa(){
        global $mysqli;
        $reserva = $_REQUEST['reserva'];
        $lareserva = '';
        $sql = "SELECT  r.id
                    FROM habitacion h 
                    JOIN tipo_habitacion t ON h.id_tipo_habitacion = t.id
                    JOIN reservacion r ON h.id = r.id_habitacion
                    JOIN cliente c ON r.id_cliente = c.id
                    WHERE h.id = $reserva AND r.estatus = 'A'";
        $result = $mysqli->query($sql);
        while($row = $result->fetch_assoc()){
            $lareserva = $row['id'];
        }

        $sql = "SELECT * FROM acompanante WHERE id_reserva = $lareserva";
        $result = $mysqli->query($sql);
        $tabla = '';
        $tabla .= '
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Telefono</td>
                        <td>Eliminar</td>
                    </tr>
                </thead>
                ';
        while($row = $result->fetch_assoc()){

            $tabla .= '
                <tr>
                    <td>'.$row['nombre'].'</td>
                    <td>'.$row['apellido'].'</td>
                    <td>'.$row['telefono'].'</td>
                    <td><button id="'.$row['id'].'"  type="button" class="fa fa-times btn btn-danger deleteAcomp"></button></td>
                </tr>';
        }
        echo $tabla;

    }

    function addAcomp(){
        global $mysqli;

        $nombre = $_REQUEST['nombre'];
        $apellido = $_REQUEST['apellido'];
        $telefono = $_REQUEST['telefono'];
        $reserva = $_REQUEST['reserva'];
        $limit = $_REQUEST['limit'];

        $sql ="SELECT count(*) as cant FROM acompanante WHERE id_reserva = $reserva";
        $resultP = $mysqli->query($sql); 
		$rowP = $resultP->fetch_assoc();
        if($rowP['cant'] >= ($limit-1)){
            echo 0;
        }else{
            $sql = "INSERT INTO acompanante(nombre,apellido,telefono,id_reserva) values('$nombre','$apellido','$telefono',$reserva)";
            $mysqli->query($sql);
            echo 1;
        }


    }

    function deleteAcomp(){
        global $mysqli;

        $id = $_REQUEST['id'];
        $sql = "delete from acompanante where id=$id";
        $result = $mysqli->query($sql);
        return 1;

    }

    function reporte_clientes(){
        global $mysqli;

        $fechai = $_REQUEST['fechai'];
        $fechaf = $_REQUEST['fechaf'];

        $sql = "SELECT CONCAT(c.tipo_cliente, '', c.cedula) as 
                cedula, CONCAT(c.nombre, ' ', c.apellido) as cliente, c.telefono, 
                count(r.id_cliente) as visitas FROM reservacion r 
                JOIN cliente c ON c.id = r.id_cliente WHERE 1";

        if($fechai != '' && $fechaf != ''){
            $sql .= " AND (DATE_FORMAT(r.fecha_reserva, '%d/%m/%Y') BETWEEN DATE_FORMAT('$fechai', '%d/%m/%Y') AND DATE_FORMAT('$fechaf', '%d/%m/%Y'))";
        }

        $sql.= " GROUP BY r.id_cliente ORDER BY visitas";


        $result = $mysqli->query($sql);
        $tabla = '';
        $tabla .= '
                <thead>
                    <tr>
                        <td>Cedula</td>
                        <td>Cliente</td>
                        <td>Telefono</td>
                        <td>Nro. Reservas</td>                        
                    </tr>
                </thead>
                ';
        while($row = $result->fetch_assoc()){

            $tabla .= '
                    <tr>
                        <td>'.$row['cedula'].'</td>
                        <td>'.$row['cliente'].'</td>
                        <td>'.$row['telefono'].'</td>
                        <td>'.$row['visitas'].'</td>
                    </tr>              
                    ';
        }   
        echo $tabla;

    }