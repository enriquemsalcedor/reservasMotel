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

                    
                        <div class="row" style="text-align: center;">
                                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="card-box noradius noborder " style="height: 170px;">
                                                <h5 class="text-uppercase m-b-20">Acerca del sistema</h5>
                                                <p class="m-b-10 counter">
                                                    Sistema bajo entorno web para el Control de Registro y Reserva del "Motel Caseteja". Yaritagua, 2025
                                                </p>
                                                <p class="m-b-10 counter">
                                                    Version 1.0.0
                                                </p>
                                                <p class="m-b-10 counter">
                                                    Fecha de ultima actualización: 29/01/2026
                                                </p>

                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="card-box noradius noborder" style="height: 170px;">
                                                <h5 class=" text-uppercase m-b-20">Manual de usuario</h5>
                                                <p>Documento redactado para administradores del sistema, que describe cómo configurar, gestionar y mantener el sistema o realizar procesos de manera mas eficiente.</p>
                                                <button  type="button" class="fa fa-file-pdf-o btn btn-success"> Descargar PDF</button>

                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="card-box noradius noborder" style="height: 170px;">
                                                <h5 class=" text-uppercase m-b-20">Manual de sistema</h5>
                                                <p>Guía dirigida al usuario final que explica, de forma sencilla cómo hacer uso de las funcionalidares básicas del sistema, para asi prestar un servicio optimo al cliente.</p>
                                                <button  type="button" class="fa fa-file-pdf-o btn btn-"> Descargar PDF</button>                                                  
                                                
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="card-box noradius noborder" style="height: 140px;">
                                                <h5 class=" text-uppercase m-b-20">Estado del respaldo</h5>
                                                 <?php
                                                        require_once '../clases/Reporte.php';
                                                        require_once '../clases/Conexion.php';
                                                        $obj2 = new Reporte();
                                                        $r2 = $obj2->respaldos();
                                                        if(empty($r2))
                                                        {
                                                        echo "<h1>0</h1>";
                                                        }
                                                        else
                                                        {
                                                        echo '<h1>'.$r2.'</h1>';
                                                        }
                                                        
                                                        $r3 = $obj2->respaldoFecUlt();
                                                        if(empty($r3))
                                                        {
                                                        echo "<h1></h1>";
                                                        }
                                                        else
                                                        {
                                                        echo "<p>Ultima fecha: ".$r3."</p>";
                                                        }
                                                ?>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="card-box noradius noborder" style="height: 140px;">
                                                <h5 class=" text-uppercase m-b-20">Eventos</h5>
                                                <?php
                                                        require_once '../clases/Reporte.php';
                                                        require_once '../clases/Conexion.php';
                                                        $obj2 = new Reporte();
                                                        $r2 = $obj2->eventos();
                                                        if(empty($r2))
                                                        {
                                                        echo "<h1>0</h1>";
                                                        }
                                                        else
                                                        {
                                                        echo '<h1>'.$r2.'</h1>';
                                                        }
                                                ?>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="card-box noradius noborder" style="height: 140px;">
                                                <h5 class="text-uppercase m-b-20">Inicios de sesión</h5>
                                                <?php
                                                require_once '../clases/Reporte.php';
                                                require_once '../clases/Conexion.php';
                                                $obj2 = new Reporte();
                                                $r2 = $obj2->inicios_sesion();
                                                if(empty($r2))
                                                {
                                                echo "<h1>0</h1>";
                                                }
                                                else
                                                {
                                                echo '<h1>'.$r2.'</h1>';
                                                }
                                                ?>
                                        </div>
                                </div>
                        </div>

        </div>                   

    </div>
<!-- END content-page -->



<?php
require 'footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>
<script>
$(document).ready(function() {

    reservaDia();

    const xValues = ["Italy", "France", "Spain", ];
    const yValues = [55, 49, 44];
    const barColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
    ];

    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        plugins: {
        legend: {display:true},
        title: {
            display: true,
            text: "Tipo habitación",
            font: {size:16}
        }
        }
    }
    });
			

} );	

function reservaDia(){
        datos = {
                    'accion': 'reservaDia'
                }

        $.ajax({
            method : "GET",
            url : "../procesos/reserva/funciones.php",
            data: datos
        }).done(function(msg) {
            $("#tblreserva").empty();
            $("#tblreserva").append(msg);
            

        });

    }

    function descargarManualSis(){
        window.open ("../documentos/Manual Administrador.pdf");

    }

    function descargarManualUsu(){
        window.open ("../documentos/_Manual Usuario.pdf");
    }
</script>
	
	
<!-- END Java Script for this page -->


<?php
}
else {
	header("location:../index.php");  
}

?>