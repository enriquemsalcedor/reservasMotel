<?php
class TipoUsuario{
    public function save($nombrer)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $nombre = $c->test_input($nombrer);
        $sql = "INSERT INTO tipo_usuario(nombre,estatus) values('$nombre','A')";
        $result = mysqli_query($conexion,$sql);
        return $result;
    }
        public function edit($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $nombre = $c->test_input($datos[1]);
        $sql = "update tipo_usuario set nombre = '$nombre' where id=$datos[0]";
        $result = mysqli_query($conexion,$sql);
        return $result;
    }
        public function delete($id)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "update tipo_usuario set estatus = 'E' where id=$id";
        $result = mysqli_query($conexion,$sql);
        return $result;
    }
    public function mostrar()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from tipo_usuario WHERE estatus <> 'E'";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }
    public function traer($id)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from tipo_usuario where id=$id";
			$result = mysqli_query($conexion,$sql);
            $ver = mysqli_fetch_row($result);
            return html_entity_decode($ver[1]); 
    }
    
    public function mostrar_cb()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from tipo_usuario";
			$result = mysqli_query($conexion,$sql);
            return $result;         
    }
    
}


?>