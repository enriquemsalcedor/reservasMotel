<?php
class Vehiculo{
    public function save($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $idcliente = $c->test_input($datos[0]);
        $placa = $c->test_input($datos[1]);
        $modelo = $c->test_input($datos[2]);
        
        $sql = "INSERT INTO vehiculo(idcliente,placa,modelo,fecha,estatus) 
                values($idcliente,'$placa','$modelo',Now(),'A')";
        $result = mysqli_query($conexion,$sql);
        return $result;
    }
    
    public function edit($datos)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $id = $datos[0];
        $idcliente = $c->test_input($datos[1]);
        $placa = $c->test_input($datos[2]);
        $modelo = $c->test_input($datos[3]);
        
        $sql = "update vehiculo set id_cliente = idcliente, placa = '$placa', modelo = $modelo where id = $id";
        $result = mysqli_query($conexion,$sql);
        return $result;
    }
    public function delete($id)
    {
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "DELETE FROM vehiculo WHERE id=$id";
        $result = mysqli_query($conexion,$sql);
        return $result;
    }
    public function mostrar()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "SELECT CONCAT(c.nombre, ' ', c.apellido) as cliente, v.placa, v.modelo, v.id FROM vehiculo v
				JOIN cliente c ON v.idcliente = c.id ";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }
    public function clientesReserva()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "SELECT c.id, CONCAT(c.nombre, ' ', c.apellido) as cliente
                FROM reservacion r 
				JOIN cliente c ON r.id_cliente = c.id 
				";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }
    

    
}
