<?php
class Bitacora{


		public function mostrar()
    	{
			global $usuario;
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "SELECT * FROM bitacora ORDER BY id DESC";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    	}
		
		public function save($datos)
		{
			$c = new Conexion();
			$conexion = $c->conectar();
			$usuario = $c->test_input($datos[0]);
			$accion = $c->test_input($datos[1]);
			$modulo = $c->test_input($datos[2]);
			
			$sql = "INSERT INTO bitacora(usuario,accion,fecha,modulo) values('$usuario','$accion',Now(),'$modulo')";
			$result = mysqli_query($conexion,$sql);
			return $result;
		}
		


}


?>