<?php
class Cliente{
    public function save($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $cedula = $c->test_input($datos[0]);
        $nombre = $c->test_input($datos[1]);
        $apellido = $c->test_input($datos[2]);
        $telefono = $c->test_input($datos[3]);
        $direccion = $c->test_input($datos[4]);
        $sql = "INSERT INTO cliente(nombre,apellido,cedula,telefono,direccion,estatus) 
                values('$nombre','$apellido','$cedula','$telefono','$direccion','A')";
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
			$sql = "SELECT * FROM cliente";
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
			$sql = "select * from cliente where id=$id";
			$result = mysqli_query($conexion,$sql);
            $ver = mysqli_fetch_row($result);
            $datos = array(
               "id" =>html_entity_decode($ver[0]),
               "nombre" =>html_entity_decode($ver[1]),
               "apellido" =>html_entity_decode($ver[2]),
               "telefono" =>html_entity_decode($ver[3]),
               "direccion" =>html_entity_decode($ver[4]),
               "estatus" =>html_entity_decode($ver[5]),
             );
            return $datos;
    }
    
    public function buscar($cedula)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "SELECT * FROM cliente WHERE cedula = '$cedula'";
			$result = mysqli_query($conexion,$sql);
            if($result->num_rows > 0){
                $ver = mysqli_fetch_row($result);
                $datos = array(
                "id" =>html_entity_decode($ver[0]),
                "cedula" =>html_entity_decode($ver[1]),
                "nombre" =>html_entity_decode($ver[2]),
                "apellido" =>html_entity_decode($ver[3]),
                "telefono" =>html_entity_decode($ver[4]),
                "direccion" =>html_entity_decode($ver[5]),
                );
            }else{
                $datos = 0;
            }
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
