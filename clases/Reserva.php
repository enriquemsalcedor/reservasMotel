<?php
session_start();
class Reserva{

        public function traer($id)
        {
            $c = new Conexion();
            $conexion = $c->conectar();

            $sql = "SELECT h.id, h.numero, r.precio_total as total, t.nombre as tipo_habitacion, h.descripcion,
                    DATE_FORMAT(r.fecha_reserva, '%d/%m/%Y') as fecha_reserva, 
                    DATE_FORMAT(r.fecha_finalizacion, '%d/%m/%Y') as fecha_finalizacion, r.id as reserva,
                    CONCAT(c.nombre,' ',c.apellido) as cliente, CONCAT(c.tipo_cliente,'',c.cedula) as cedula,
                    h.maxpersona, r.id
                    FROM habitacion h 
                    JOIN tipo_habitacion t ON h.id_tipo_habitacion = t.id
                    JOIN reservacion r ON h.id = r.id_habitacion
                    JOIN cliente c ON r.id_cliente = c.id
                    WHERE h.id = $id AND r.estatus = 'A'";
            $result = mysqli_query($conexion,$sql);
            $ver = mysqli_fetch_row($result);
            $datos = array(
            "id" =>html_entity_decode($ver[0]),
            "numero" =>html_entity_decode($ver[1]),
            "total" =>html_entity_decode($ver[2]),
            "tipo_habitacion" =>html_entity_decode($ver[3]),
            "descripcion" =>html_entity_decode($ver[4]),
            "fecha_reserva" =>html_entity_decode($ver[5]),
            "fecha_finalizacion" =>html_entity_decode($ver[6]),
            "reserva" =>html_entity_decode($ver[7]),
            "cedula" =>html_entity_decode($ver[8]),
            "cliente" =>html_entity_decode($ver[9]),
            "maxpersona" =>html_entity_decode($ver[10]),
            );
            return $datos;
        }
    

		public function finalizarReserva($id)
		{
			$c = new Conexion();
			$conexion = $c->conectar();
			$sql = "update habitacion set id_estado_habitacion = 2 where id=$id";
			$result = mysqli_query($conexion,$sql);
            
            if($result == true){
                $usuario = $_SESSION['usuario'];
                $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se finalizo la reserva #$id','Reserva',Now())";
                mysqli_query($conexion,$sqlx);
            }
			return $result;
		}

		



}


?>