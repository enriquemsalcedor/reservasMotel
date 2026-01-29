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
                            <label for="">Tipo de Reserva</label>
                            <select class="form-control" id="selecttiporeserva">
                                <option value="0">Todos</option>
                                <option value="Por dia">Por dia</option>
                                <option value="Por hora">Por hora</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-6 col-xl-3">
                            <label for="">Fecha de reserva desde :</label>
                            <input type="date"  class="form-control"id="txtfechai">
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-6 col-xl-3">
                            <label for="">Fecha de reserva hasta:</label>
                            <input type="date" class="form-control" id="txtfechaf">
                        </div>                        
                        
                    </div>
                    <div class="row mb-1">
                        <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12" style="text-align: right;">
                            <button type="button" class="btn btn-primary fa fa-eraser" id="btnlimpiar"></button>
                            <button type="button" class="btn btn-primary fa fa-file-pdf-o" id="btnImprimir"></button>
                            <button type="button" class="btn btn-primary fa fa-filter" id="btnfiltrar"></button>
                        </div>
                    </div>
                    
                    <!-- end row -->
                     <table id="list" class="table table-bordered table-hover table-condensed">

                     </table>
                                         

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
        list()
        
    });

    $(document).on('click', '#btnImprimir', function() {
        console.log('--->')
        var tiporeserva = $('#selecttiporeserva').val();
        var tipo = $('#selecttipohabitacion').val();
        var fechai = $('#txtfechai').val();
        var fechaf = $('#txtfechaf').val();
        var tiponombre = $('#selecttipohabitacion').text();  
        
        window.open ("../procesos/reporte/reservas_pdf.php?tiporeserva="+tiporeserva+"&tipo="+tipo+"&fechai="+fechai+"&fechaf="+fechaf+"&tiponombre="+tiponombre, "_blank");

        
    });

    $(document).on('click', '#btnlimpiar', function() {
        $('#selecttiporeserva').val('0'); 
        $('#selecttipohabitacion').val('0');
        $('#txtfechai').val('');
        $('#txtfechaf').val('');

        $("#list").empty();
        
    });

    function list(){
        datos = {
                    'tiporeserva' : $('#selecttiporeserva').val(), 
                    'tipo'   : $('#selecttipohabitacion').val(),
                    'fechai' : $('#txtfechai').val(),
                    'fechaf' : $('#txtfechaf').val(),
                    'accion' : 'reporte'
                }

        $.ajax({
            method : "POST",
            url : "../procesos/reserva/funciones.php",
            data: datos
        }).done(function(msg) {
            $("#list").empty();
            $("#list").append(msg);
            

        });

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
