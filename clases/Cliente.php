<?php
session_start();
class Cliente{
    public function save($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $tipo = $c->test_input($datos[0]);
        $cedula = $c->test_input($datos[1]);
        $nombre = $c->test_input($datos[2]);
        $apellido = $c->test_input($datos[3]);
        $telefono = $c->test_input($datos[4]);
        $direccion = $c->test_input($datos[5]);
        $sql = "INSERT INTO cliente(tipo_cliente,nombre,apellido,cedula,telefono,direccion,estatus) 
                values('$tipo','$nombre','$apellido','$cedula','$telefono','$direccion','A')";
        $result = mysqli_query($conexion,$sql);
        
        if($result == true){
            $id = $mysqli->insert_id;
            $usuario = $_SESSION['usuario'];
            $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se creo el cliente #$id','Cliente',Now())";
            mysqli_query($conexion,$sqlx);
        }
        return $result;
    }
    
    public function edit($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        // $datos = array($id,$txttipocliente,$txtcedula,$txtnombre,$txtapellido,$txttelefono,$txtdireccion,$txtestatus);
        $id = $datos[0];
        $tipocliente = $c->test_input($datos[1]);
        $cedula = $c->test_input($datos[2]);
        $nombre = $c->test_input($datos[3]);
        $apellido = $c->test_input($datos[4]);
        $telefono = $c->test_input($datos[5]);
        $direccion = $c->test_input($datos[6]);
        $estatus = $c->test_input($datos[7]);

        $sql = "update cliente set tipo_cliente = '$tipocliente', cedula = '$cedula', 
                            nombre = '$nombre', apellido = '$apellido', 
                            telefono = '$telefono', direccion = '$direccion', estatus = '$estatus' where id=$id";
        $result = mysqli_query($conexion,$sql);
        if($result == true){
           
            $usuario = $_SESSION['usuario'];
            $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se edito el cliente#$id','Cliente',Now())";
            mysqli_query($conexion,$sqlx);
        }
        return $result;
    }
    public function delete($id)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "update cliente set estatus = 'E' where id=$id";
        
        $result = mysqli_query($conexion,$sql);
        if($result == true){
            $usuario = $_SESSION['usuario'];
            $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se elimino el cliente #$id','Cliente',Now())";
            mysqli_query($conexion,$sqlx);
        }
        return $result;
    }

    public function mostrar()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "SELECT id, CONCAT(tipo_cliente,cedula) as cedula, nombre, apellido, telefono, estatus FROM cliente WHERE estatus <> 'E'";
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
               "tipo_cliente" =>html_entity_decode($ver[1]),
               "cedula" =>html_entity_decode($ver[2]),
               "nombre" =>html_entity_decode($ver[3]),
               "apellido" =>html_entity_decode($ver[4]),
               "telefono" =>html_entity_decode($ver[5]),
               "direccion" =>html_entity_decode($ver[6]),
               "estatus" =>html_entity_decode($ver[7]),
             );
            return $datos;
    }
    
    public function buscar($cedula,$tipo)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "SELECT * FROM cliente WHERE cedula = '$cedula' AND tipo_cliente='$tipo'";
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
                $usuario = $_SESSION['usuario'];
                $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se consulto cedula del cliente #$ver[0]','Cliente',Now())";
                mysqli_query($conexion,$sqlx);
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
