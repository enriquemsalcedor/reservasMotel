<?php
class Habitacion{
    public function save($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $numero = $c->test_input($datos[0]);
        $desc = $c->test_input($datos[1]);
        $tipo_habitacion = $c->test_input($datos[2]);
        $estado_habitacion = $c->test_input($datos[3]);
        $precio = $c->test_input($datos[4]);
        $estatus = $c->test_input($datos[5]);
        $sql = "INSERT INTO habitacion(nombre,descripcion,id_tipo_habitacion,id_estado_habitacion,precio,estatus) 
                values('$nombre','$desc',$tipo_habitacion,$estado_habitacion,$precio','$estatus')";
        $result = mysqli_query($conexion,$sql);
        return $result;
    }
    
    public function edit($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $id = $datos[0];
        $nombre = $c->test_input($datos[0]);
        $desc = $c->test_input($datos[1]);
        $tipo_habitacion = $c->test_input($datos[2]);
        $estado_habitacion = $c->test_input($datos[3]);
        $precio = $c->test_input($datos[4]);
        $estatus = $c->test_input($datos[5]);
        $sql = "update habitacion set numero = '$numero', descripcion = '$desc', id_tipo_habitacion = $id_tipo_habitacion,
        id_estado_habitacion = $estado_habitacion, precio = $precio, estatus = '$estatus' where id=$id";
        $result = mysqli_query($conexion,$sql);
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
    public function habitacionReserva(){
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "SELECT h.numero, h.precio, e.nombre as estado, e.color, t.nombre as tipo_habitacion 
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
               "precio_venta" =>html_entity_decode($ver[3]),
               "stock" =>html_entity_decode($ver[4]),
               "id_proveedor" =>html_entity_decode($ver[5]),
               "id_categoria" =>html_entity_decode($ver[7])
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

                public function stock($id,$stock)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "update productos set stock = stock + '$stock' where id_producto=$id";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }
    
}
