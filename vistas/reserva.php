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
                                <h1 class="main-title float-left"><?php echo $_SESSION['datos']->tipo_usuario ?></h1>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                        <div class="row">
                    <?php
                        require_once '../clases/Conexion.php';
                        require_once '../clases/Habitacion.php';
                        $obj = new Habitacion();
                        $result = $obj->habitacionReserva();
                        while($fila=mysqli_fetch_row($result))
                        {
                    ?>
                        
                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                            <div class="card-box noradius noborder" style="height: 275px; background-color:<?php echo $fila[3]?>;">
                                <div style="display:flex;">
                                    <i class="fa fa-bed  float-right"></i>
                                </div>
                                    <h4 class="text-uppercase m-b-20"><?php echo $fila[0]; ?></h4>
                                <div style="text-align: right;">
                                    <label class=""><?php  echo $fila[4];?></label><br>
                                    <label class="text-uppercase m-b-20">$ <?php echo number_format($fila[1], 2, ',', ' ');?></label><br>
                                </div>
                                <div style="text-align: center;">
                                    <span class="text-white pill"><?php echo $fila[2];?></span>
                                </div>

                                    
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    </div>                      

        </div>
        <!-- END container-fluid -->

    </div>
    <!-- END content -->

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


$(document).on('click', '.accionesTabla', function() {
