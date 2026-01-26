<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{
date_default_timezone_set("America/Caracas");

?>

    <div class="content-page">
	
    <!-- Start content -->
    <div class="content">
        
        <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-12">
                            <label for="">Filtrar por:</label>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-6 col-xl-3">
                            <label for="">Estado Habitación:</label>
                            <select class="form-control" id="selectestadohabitacion">
                                <option value="0">Todos</option>
                                <?php
                                    require_once '../clases/EstadoHabitacion.php';
                                    require_once '../clases/Conexion.php';
                                    $obj = new EstadoHabitacion();
                                    $result = $obj->mostrar();
                                    while($fila=mysqli_fetch_row($result)){
                                ?>
                                    <option value="<?php echo $fila[0]?>"><?php echo $fila[1]?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-6 col-xl-3">
                            <label for="">Tipo habitación</label>
                            <select class="form-control" id="selecttipohabitacion">
                                <option value="0">Todos</option>
                                <?php
                                    require_once '../clases/TipoHabitacion.php';
                                    require_once '../clases/Conexion.php';
                                    $obj = new TipoHabitacion();
                                    $result = $obj->mostrar();
                                    while($fila=mysqli_fetch_row($result)){
                                ?>
                                    <option value="<?php echo $fila[0]?>"><?php echo $fila[1]?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-6 col-xl-3">
                            <label for="">Fecha de reserva:</label>
                            <input type="date"  class="form-control"id="fechar">
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-6 col-xl-3">
                            <label for="">Fecha Finalizacion:</label>
                            <input type="date" class="form-control" id="fechaf">
                        </div>                        
                        
                    </div>
                    <div class="row mb-1">
                        <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12" style="text-align: right;">
                            <button type="button" class="btn btn-primary fa fa-file-pdf-o" id="btnfiltrar"></button>
                            <button type="button" class="btn btn-primary fa fa-filter" id="btnfiltrar"></button>
                        </div>
                    </div>
                    
                    <!-- end row -->
                    <div class="row" id="list">
                    
                        
                        
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
    



    

    $(document).on('click', '#btnfiltrar', function() {
        console.log('--->')
        alertify.error("Ha ocurrido un error inesperado!");
        

    });


    function listHabitaciones(){
        datos = {
                    'estado' : $('#selectestadohabitacion').val(), 
                    'tipo'   : $('#selecttipohabitacion').val(),
                    'fechai' : $('#fechai').val(),
                    'fechaf' : $('#fechaf').val(),
                    'accion' : 'reporte'
                }

        $.ajax({
            method : "GET",
            url : "../procesos/reserva/funciones.php",
            data: datos
        }).done(function(msg) {
            $("#list").empty();
            $("#list").append(msg);
            

        });

    }

    $('.calcular').on('input', function() {
                
        updatePrice();
    });

    $(document).on("change, keyup, input", "#txtfechai", calcularfecha);

    function calcularfecha(){
        // Obtener fecha desde un input o crearla (ej. hoy)
        var fecha = new Date($('#txtfechai').val());
        var diasASumar = parseInt($('#txthoras').val());
      
        // Sumar los días
        fecha.setDate(fecha.getDate() + diasASumar);

        // Formatear la fecha resultante (YYYY-MM-DD para input[type=date])
        var nuevaFecha = fecha.toISOString().slice(0, 10);
        if( $('#selecttipo').val() == 'Por dia'){
            $('#txtfechac').val(nuevaFecha);
        }else{
            $('#txtfechac').val($('#txtfechai').val());
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
