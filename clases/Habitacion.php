<?php
session_start();
class Habitacion{
    public function save($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $numero = $c->test_input($datos[0]);
        $desc = $c->test_input($datos[1]);
        $precio = $c->test_input($datos[2]);
        $precio_hora = $c->test_input($datos[3]);
        $estado_habitacion = $c->test_input($datos[4]);
        $tipo_habitacion = $c->test_input($datos[5]);
        $maxpersona = $c->test_input($datos[6]);
        $sql = "INSERT INTO habitacion(numero,descripcion,id_tipo_habitacion,id_estado_habitacion,precio,precio_hora,estatus,maxpersona) 
                values('$numero','$desc',$tipo_habitacion,$estado_habitacion,$precio,$precio_hora,'A',$maxpersona)";
        $result = mysqli_query($conexion,$sql);

        if($result == true){
            $usuario = $_SESSION['usuario'];
            $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se creo la habitacion #$numero','Habitacion',Now())";
            mysqli_query($conexion,$sqlx);
        }
        return $result;
    }
    
    public function edit($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();

        $id = $datos[0];
        $numero = $c->test_input($datos[1]);
        $desc = $c->test_input($datos[2]);
        $precio = $c->test_input($datos[3]);
        $preciohora = $c->test_input($datos[4]);
        $estado_habitacion = $c->test_input($datos[5]);
        $tipo_habitacion = $c->test_input($datos[6]);
        $estatus = $c->test_input($datos[7]);
        $maxpersona = $c->test_input($datos[8]);

        $sql = "update habitacion set numero = '$numero', 
            descripcion = '$desc', id_tipo_habitacion = $tipo_habitacion,
            id_estado_habitacion = $estado_habitacion, precio = $precio, precio_hora = $preciohora, 
            estatus = '$estatus', 
            maxpersona = $maxpersona where id=$id";
        $result = mysqli_query($conexion,$sql);
        if($result == true){
            $usuario = $_SESSION['usuario'];
            $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se edito la habitacion #$numero','Cliente',Now())";
            mysqli_query($conexion,$sqlx);
        }
        return $result;
    }
    public function delete($id)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "update habitacion set estatus = 'E' where id=$id";
        $result = mysqli_query($conexion,$sql);
        return $result;
    }
    public function mostrar()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "SELECT h.*, e.nombre as estado, t.nombre as tipo_habitacion FROM habitacion h 
				JOIN tipo_habitacion t ON h.id_tipo_habitacion = t.id 
				JOIN estado_habitacion e ON h.id_estado_habitacion = e.id
                WHERE h.estatus <> 'E'";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }
    public function habitacionReserva()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "SELECT h.numero, h.precio, e.nombre as estado, e.color, t.nombre as tipo_habitacion, h.id
                FROM habitacion h 
				JOIN tipo_habitacion t ON h.id_tipo_habitacion = t.id 
				JOIN estado_habitacion e ON h.id_estado_habitacion = e.id
                WHERE h.estatus <> 'E'";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }
    public function traer($id)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from habitacion where id=$id";
			$result = mysqli_query($conexion,$sql);
            $ver = mysqli_fetch_row($result);
            $datos = array(
               "id" =>html_entity_decode($ver[0]),
               "numero" =>html_entity_decode($ver[1]),
               "descripcion" =>html_entity_decode($ver[2]),
               "id_tipo_habitacion" =>html_entity_decode($ver[3]),
               "id_estado_habitacion" =>html_entity_decode($ver[4]),
               "precio" =>html_entity_decode($ver[5]),
               "precio_hora" =>html_entity_decode($ver[6]),
               "maxpersona" =>html_entity_decode($ver[7]),
               "estatus" =>html_entity_decode($ver[8]),
             );
            return $datos;
    }
    
    public function traerDatos($id)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "SELECT h.id, h.numero, h.precio, h.precio_hora, t.nombre as tipo_habitacion, h.descripcion
                    FROM habitacion h 
				    JOIN tipo_habitacion t ON h.id_tipo_habitacion = t.id 
                    WHERE h.id = $id";
			$result = mysqli_query($conexion,$sql);
            $ver = mysqli_fetch_row($result);
            $datos = array(
               "id" =>html_entity_decode($ver[0]),
               "numero" =>html_entity_decode($ver[1]),
               "precio" =>html_entity_decode($ver[2]),
               "precio_hora" =>html_entity_decode($ver[3]),
               "tipo_habitacion" =>html_entity_decode($ver[4]),
               "descripcion" =>html_entity_decode($ver[5]),
             );
            return $datos;
    }
    
    public function traer_datos_cb($id)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select precio_venta,stock from productos where id_producto=$id";
			$result = mysqli_query($conexion,$sql);
            $ver = mysqli_fetch_row($result);
            $datos = array(
            "precio_venta" =>html_entity_decode($ver[0]),
            "stock" =>html_entity_decode($ver[1])
            );
            return $datos;
    }

    
}
