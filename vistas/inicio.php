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
                                <h6>Reservas en la semana</h6>
                                <div>
                                    <canvas id="myChartBarra" style="width:100%;max-width:600px"></canvas>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                                <h6>Reservas por tipo de habitación</h6>
                                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-12">
                                <br>
                                <h6>Reservas activas</h6>
                                <table id="tblreserva" class="table table-bordered table-hover table-condensed">  
                                    <tbody>

                                    </tbody>
                                </table>
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
    estados();
    getDolar();
    

    const xValues = ["Reservada", "Disponible", "Mantenimiento", ];
    const yValues = [55, 49, 44];
    const barColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
    ];
    

    
			

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

    
    function estados(){
        var x = [];
        var y = [];
        var color = [];
        const barColors = [
            "#f50f1b",
            "#44d605",
            "#f0e80f",
        ];
        
        datos = {
                    'accion': 'reporteEstados'
                }

        $.ajax({
            method : "GET",
            url : "../procesos/funciones.php",
            data: datos
        }).done(function(data) {
            
            console.log(data)
            var arr = JSON.parse(data);
            $.each(JSON.parse(data), function(i, item) {
                console.log(item.color);
                x.push(item.name);
                y.push(parseInt(item.y));
                color.push(item.color);
            });
            console.log(x)
            console.log(y)

            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: x,
                datasets: [{
                backgroundColor: barColors,
                data: y
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

        });

    }

    function getDolar(){
        $.get("https://ve.dolarapi.com/v1/dolares/oficial", function( data ) {
            console.log( data );
            $('#dolar').append(parseFloat(data.promedio).toFixed(2) + ' Bs.')
            const fecha = new Date(data.fechaActualizacion);
            $('#ultima_act').append(fecha.toLocaleDateString())
            
        });
    }

const xValues = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];
const yValues = [55, 49, 44, 24, 15, 30, 60];
const barColors = ["blue","blue","blue","blue","blue","blue","blue"];

const ctx = document.getElementById('myChartBarra');

new Chart(ctx, {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    plugins: {
      legend: {display: false},
      title: {
        display: true,
        text: "",
        font: {size: 16}
      }
    }
  }
});


</script>
	
	
<!-- END Java Script for this page -->


<?php
}
else {
	header("location:../index.php");  
}

?>