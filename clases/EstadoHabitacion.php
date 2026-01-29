<?php
session_start();
class EstadoHabitacion{
    public function save($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
		$nombre = $c->test_input($datos[0]);
        $color = $c->test_input($datos[1]);
        $sql = "INSERT INTO estado_habitacion(nombre,color,estatus) values('$nombre','$color','A')";
        $result = mysqli_query($conexion,$sql);
        if($result == true){
            $id = $mysqli->insert_id;
            $usuario = $_SESSION['usuario'];
            $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se creo el estado habitacion #$id','Estado habitacion',Now())";
            mysqli_query($conexion,$sqlx);
        }
        return $result;
    }
        public function edit($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $nombre = $c->test_input($datos[1]);
        $color = $c->test_input($datos[2]);
        $sql = "update estado_habitacion set nombre = '$nombre', color = '$color' where id=$datos[0]";
        $result = mysqli_query($conexion,$sql);
        if($result == true){
            $usuario = $_SESSION['usuario'];
            $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se edito el estado habitacion #$id','Estado habitacion',Now())";
            mysqli_query($conexion,$sqlx);
        }
        return $result;
    }
    public function delete($id)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "update estado_habitacion set estatus = 'E' where id=$id";
        $result = mysqli_query($conexion,$sql);
        if($result == true){
            $usuario = $_SESSION['usuario'];
            $sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Se elimino el estado habitacion #$id','Estado habitacion',Now())";
            mysqli_query($conexion,$sqlx);
        }

        return $result;
    }
    public function mostrar()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from estado_habitacion WHERE estatus <> 'E'";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }
    public function traer($id)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from estado_habitacion where id=$id";
			$result = mysqli_query($conexion,$sql);
            $ver = mysqli_fetch_row($result);
            $datos = array(
               "id" =>html_entity_decode($ver[0]),
               "nombre" =>html_entity_decode($ver[1]),
               "color" =>html_entity_decode($ver[2]),
               "estatus" =>html_entity_decode($ver[3]),
            );
            return $datos; 
    }
    
    public function mostrar_cb()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from estado_habitacion";
			$result = mysqli_query($conexion,$sql);
            return $result;         
    }
    
}


?>