<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{
date_default_timezone_set("America/Lima");

?>



    <div class="content-page">
	
    <!-- Start content -->
    <div class="content">
        
        <div class="container-fluid">
                
                    <div class="row">
                                <div class="col-xl-12">
                                        <div class="breadcrumb-holder">
                                                <div class="clearfix"></div>
                                        </div>
                                </div>
                    </div>
                    <!-- end row -->

                    
                        <div class="row">
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card-box noradius noborder bg-default" style="height: 140px;">
                                                <i class="fa fa-bed  float-right text-white"></i>
                                                <h5 class="text-white text-uppercase m-b-20">Reservas del Dia</h5>
                                                <h4 class="m-b-20 text-white counter">
                                                    <?php
                                                        require_once '../clases/Reporte.php';
                                                        require_once '../clases/Conexion.php';
                                                        $obj1 = new Reporte();
                                                        $r1 = $obj1->reservas_dia();
                                                        echo $r1;
                                                    ?>
                                                </h4>
                                                <span class="text-white"><br><br></span>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card-box noradius noborder bg-warning" style="height: 140px;">
                                                <i class="fa fa-money float-right text-white"></i>
                                                <h5 class="text-white text-uppercase m-b-20">Dinero del Dia</h5>
                                                <h4 class="m-b-20 text-white counter">
                                                    <?php
                                                        require_once '../clases/Reporte.php';
                                                        require_once '../clases/Conexion.php';
                                                        $obj1 = new Reporte();
                                                        $r1 = $obj1->dinero_dia();
                                                        if(empty($r1))
                                                        {
                                                            echo "$ 0.00";
                                                        }
                                                        else
                                                        {
                                                            echo "$ ". number_format($r1, 2, ',', ' ');
                                                        }
                                                        
                                                    ?>
                                                </h4>
                                                <span class="text-white"><br><br></span>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card-box noradius noborder bg-success" style="height: 140px;">
                                                <i class="fa fa-car float-right text-white"></i>
                                                <h5 class="text-white text-uppercase m-b-20">Vehículos del dia</h5>
                                                <h4 class="m-b-20 text-white counter">
                                                                    <?php
                                                                        require_once '../clases/Reporte.php';
                                                                        require_once '../clases/Conexion.php';
                                                                        $obj2 = new Reporte();
                                                                        $r2 = $obj2->vehiculos_dia();
                                                                        if(empty($r2))
                                                                        {
                                                                            echo "0";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $r2;
                                                                        }
                                                                    ?>
                                                </h4>
                                                <span class="text-white"><br></span>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                        <div class="card-box noradius noborder bg-danger" style="height: 140px;">
                                                <i class="fa fa-male float-right text-white"></i>
                                                <h5 class="text-white text-uppercase m-b-20">Total Clientes Atendidos</h5>
                                                <h4 class="m-b-20 text-white counter">
                                                        <?php
                                                            require_once '../clases/Reporte.php';
                                                            require_once '../clases/Conexion.php';
                                                            $obj2 = new Reporte();
                                                            $r2 = $obj2->total_clientes();
                                                            if(empty($r2))
                                                            {
                                                                echo "0";
                                                            }
                                                            else
                                                            {
                                                                echo $r2;
                                                            }
                                                        ?>
                                                </h4>
                                                <span class="text-white"><br></span>
                                        </div>
                                </div>
                        </div>
                        <!-- end row -->


                        
                        <div class="row">

                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-8">
                        
                            <H4>Reservas activas</H4>
                            <table id="dtventas" class="table table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Habitación</td>
                                        <td>Cliente</td>
                                        <td>Fecha Inicio</td>
                                        <td>Fecha Fin</td>
                                        <td style="width:15px"></td>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                    //     require_once '../clases/Conexion.php';
                                    //     require_once '../clases/Reporte.php';
                                    //     $obj = new Reporte();
                                    //     $result = $obj->productos_0();
                                    // while($fila=mysqli_fetch_row($result))
                                    {
                                ?>
                                    <tr>
                                    </tr>
                                    <?php
                                } ?>

                            </tbody>
                        </table>
                    </div>
        </div>                   

    </div>
<!-- END content-page -->



<?php
require 'footer.php';
?>

<script>
$(document).ready(function() {
			

} );		
</script>
	
	
<!-- END Java Script for this page -->


<?php
}
else {
	header("location:../index.php");  
}

?>