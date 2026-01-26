<?php
class Usuario{
    
		public function login($datos)
		{
			$c = new Conexion();
			$conexion = $c->conectar();
			// $password = mysqli_real_escape_string($conexion,sha1(md5($datos[1])));
			$password = mysqli_real_escape_string($conexion,$datos[1]);
			$usuario = mysqli_real_escape_string($conexion,$datos[0]);
			$sql = "select u.*, t.nombre as tipo_usuario from usuario u
					JOIN tipo_usuario t ON t.id = u.id_tipo_usuario
					where u.usuario='$usuario' and u.clave='$password'";
			$result = mysqli_query($conexion,$sql);

			if(mysqli_num_rows($result) > 0)
			{
                $_SESSION['usuario'] = $datos[0];
                $_SESSION['datos'] = $result->fetch_object();
				$usuario = $_SESSION['usuario'];
				
				return 1;
			}
			else
			{
				return 0;
			}
		}
        public function cambiarpass($passwords)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
			$password = $passwords;
            $usuario = $_SESSION['datos']->usuario;
			$sql = "UPDATE usuario SET clave = '$password' where usuario='$usuario'";
			$result = mysqli_query($conexion,$sql);
			if($result == true){
				$usuario = $_SESSION['usuario'];
				$sqlx = "INSERT INTO bitacora(usuario,accion,modulo,fecha) values('$usuario','Cambio de clave','Usuario',Now())";
				$result = mysqli_query($conexion,$sqlx);
			}
            return $result;
        }

		public function mostrar()
    	{
			global $usuario;
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "SELECT u.*, t.nombre AS tipo_usuario FROM usuario u 
					JOIN tipo_usuario t ON t.id = u.id_tipo_usuario
					WHERE u.estatus <> 'E'";
			$result = mysqli_query($conexion,$sql);
			
            return $result; 
    	}
		
		public function save($datos)
		{
			$c = new Conexion();
			$conexion = $c->conectar();
			$usuario = $c->test_input($datos[0]);
			$clave = $c->test_input($datos[1]);
			$tipousuario = $c->test_input($datos[2]);

			$sql = "INSERT INTO usuario(usuario,clave,id_tipo_usuario,estatus) values('$usuario','$clave',$tipousuario,'A')";
			$result = mysqli_query($conexion,$sql);
			return $result;
		}
		public function traer($id)
		{
				$c = new Conexion();
				$conexion = $c->conectar();
				$sql = "select * from usuario where id=$id";
				$result = mysqli_query($conexion,$sql);
				$ver = mysqli_fetch_row($result);
				$datos = array(
				"id" =>html_entity_decode($ver[0]),
				"usuario" =>html_entity_decode($ver[1]),
				"clave" =>html_entity_decode($ver[2]),
				"id_tipo_usuario" =>html_entity_decode($ver[3]),
				"estatus" =>html_entity_decode($ver[4]),
				);
				return $datos;
		}

		public function delete($id)
		{
			$c = new Conexion();
			$conexion = $c->conectar();
			$sql = "update usuario set estatus = 'E' where id=$id";
			$result = mysqli_query($conexion,$sql);
			return $result;
		}

		public function edit($datos)
		{
			$c = new Conexion();
			$conexion = $c->conectar();

			$id = $datos[0];
			$clave = $c->test_input($datos[1]);
			$tipousuario = $c->test_input($datos[2]);
			$estatus = $c->test_input($datos[3]);
			
			$sql = "update usuario set clave = '$clave', id_tipo_usuario = $tipousuario, estatus = '$estatus'
					where id=$id";
			$result = mysqli_query($conexion,$sql);
			return $result;
		}



}


?>