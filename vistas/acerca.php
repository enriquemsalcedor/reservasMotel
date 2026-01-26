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
                                        <div class="card-box noradius noborder " style="height: 140px;">
                                                <h6 class="text-uppercase m-b-20">Acerca del sistema</h6>
                                                <p class="m-b-20 counter">
                                                    Realizado en 2026
                                                </p>
                                                <p class="m-b-20 counter">
                                                    Version 1.0.0
                                                </p>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="card-box noradius noborder" style="height: 140px;">
                                                <h5 class=" text-uppercase m-b-20">Manual de usuario</h5>
                                                <p class="m-b-20 counter">
                                                    
                                                </p>
                                                <p class="m-b-20 counter">
                                                    
                                                </p>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="card-box noradius noborder" style="height: 140px;">
                                                <h5 class=" text-uppercase m-b-20">Manual de sistema</h5>
                                                 <p class="m-b-20 counter">
                                                    
                                                </p>
                                                <p class="m-b-20 counter">
                                                    
                                                </p>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="card-box noradius noborder" style="height: 140px;">
                                                <h5 class=" text-uppercase m-b-20">Estado del sistema</h5>
                                                 <p class="m-b-20 counter">
                                                    
                                                </p>
                                                <p class="m-b-20 counter">
                                                    
                                                </p>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="card-box noradius noborder" style="height: 140px;">
                                                <h5 class=" text-uppercase m-b-20">Eventos</h5>
                                                <p class="m-b-20 counter">
                                                    
                                                </p>
                                                <p class="m-b-20 counter">
                                                    
                                                </p>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                                        <div class="card-box noradius noborder" style="height: 140px;">
                                                <h5 class="text-uppercase m-b-20">Inicios de sesión</h5>
                                                <p class="m-b-20 counter">
                                                    
                                                </p>
                                                <p class="m-b-20 counter">
                                                    
                                                </p>
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
</script>
	
	
<!-- END Java Script for this page -->


<?php
}
else {
	header("location:../index.php");  
}

?>