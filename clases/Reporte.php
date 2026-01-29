<?php
date_default_timezone_set("America/Lima");
class Reporte{
    
    public function reservas_dia(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('d/m/Y');
            $sql = "SELECT COUNT(*) FROM reservacion where DATE_FORMAT(fecha_actual, '%d/%m/%Y') = '$fecha'";
            $result= mysqli_query($conexion,$sql);
            $re=mysqli_fetch_row($result)[0];

              return $re ;
    }
    public function dinero_dia(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('d/m/Y');
            $sql = "SELECT SUM(precio_total) FROM reservacion where DATE_FORMAT(fecha_actual, '%d/%m/%Y') = '$fecha'";
            $result= mysqli_query($conexion,$sql);
            $re=mysqli_fetch_row($result)[0];

            return $re ;
    }
    public function total_clientes(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $sql = "SELECT count(id) FROM cliente";
            $result= mysqli_query($conexion,$sql);
            $re=mysqli_fetch_row($result)[0];

            return $re ;
    }
    public function vehiculos_dia(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('d/m/Y');
            $sql = "SELECT COUNT(*) FROM vehiculo where DATE_FORMAT(fecha, '%d/%m/%Y') = '$fecha'";
            $result= mysqli_query($conexion,$sql);
            $re=mysqli_fetch_row($result)[0];

            return $re ;
    }

    public function inicios_sesion(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('d/m/Y');
            $sql = "SELECT COUNT(*) as log FROM bitacora where accion = 'Login'";
            $result= mysqli_query($conexion,$sql);
            $re=mysqli_fetch_row($result)[0];

            return $re ;
    }

    public function eventos(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('d/m/Y');
            $sql = "SELECT COUNT(*) as event FROM bitacora";
            $result= mysqli_query($conexion,$sql);
            $re=mysqli_fetch_row($result)[0];

            return $re ;
    }
    public function respaldos(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('d/m/Y');
            $sql = "SELECT count(*) FROM respaldo  ";
            $result= mysqli_query($conexion,$sql);
            $re=mysqli_fetch_row($result)[0];

            return $re ;
    }

    public function respaldoFecUlt(){
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('d/m/Y');
            $sql = "SELECT DATE_FORMAT(fecha, '%d/%m/%Y') fecha FROM respaldo  ";
            $result= mysqli_query($conexion,$sql);
            $re=mysqli_fetch_row($result)[0];

            return $re ;
    }
    
    
    
}

?>