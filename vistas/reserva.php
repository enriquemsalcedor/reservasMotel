<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{
date_default_timezone_set("America/Caracas");

?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                        <h5 id="lblnumero">Numero: </h5>
                        <label id="lbltipo">Tipo habitación: </label>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-8">
                        <label id="lbltipo">Descripción: </label>
                        <p id="descrip"></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                        <label id="">Cedula de cliente: </label>
                        <div style="display: flex; width: 100%;">
                            <input type="text" class="form-control" id="txtcedula" name="txtcedula">
                            <input type="hidden" class="form-control" id="txtid" >
                            <button id="search" class="btn btn-primary mr-2 ml-2 border-radius: 25px;"><i class="fa fa-fw fa-search"></i> <span> </span></button>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                        <label id="">Nombre de cliente: </label>
                        <input type="text" class="form-control" id="txtnombre" name="txtnombre">
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                        <label id="">Apellido de cliente: </label>
                        <input type="text" class="form-control" id="txtapellido" name="txtapellido">
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                        <label id="">Teléfono de cliente: </label>
                        <input type="text" class="form-control" id="txttelefono" name="txttelefono">
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-6 col-xl-12">
                        <label id="">Dirección de cliente: </label>
                        <input type="text" class="form-control" id="txtdireccion" name="txtdireccion">
                    </div>              
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <label id="">Tipo Reserva: </label>
                        <select class="form-control" id="selecttipo">
                            <option value="Por dia">Por dia</option>
                            <option value="Por hora">Por hora</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <label id="">Número de horas: </label>
                        <input type="number" class="form-control" id="txthoras" min = "1" max = "24">
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <label id="">Fecha Inicio: </label>
                        <input type="date" class="form-control" id="txtfechai">
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <label id="">Fecha Fin: </label>
                        <input type="date" class="form-control" id="txtfechac">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <label id="">Subtotal: </label>
                        <input type="text" class="form-control" id="txtsubtotal" disabled>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <label id="">IVA 16%: </label>
                        <input type="text" class="form-control" id="txttotaliva" disabled>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <label id="">Total: </label>
                        <input type="text" class="form-control" id="txttotal" disabled >
                    </div>
                </div>
            </div>
            

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnregistrar">Guardar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalReservado" tabindex="-1" role="dialog" aria-labelledby="modalReservado" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                        <h5 id="lblnumero2">Numero: </h5>
                        <label id="lbltipo2">Tipo habitación: </label>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-8">
                        <label id="lbltipo">Descripción: </label>
                        <p id="descrip2"></p>
                    </div>
                </div>
                <hr>
            </div>
            

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnregistrar">Guardar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="content-page">
	
    <!-- Start content -->
    <div class="content">
        
        <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-12">
                            <label for="">Filtrar por:</label>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
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
                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
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
                    </div>
                    
                    <!-- end row -->
                    <div class="row" id="listhabitaciones">
                    
                        
                        
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
    listHabitaciones();

    $('#txtnombre').prop('disabled', true);
    $('#txtapellido').prop('disabled', true);
    $('#txttelefono').prop('disabled', true);
    $('#txtdireccion').prop('disabled', true);
    $('#txthoras').prop('disabled', true);
    $('#selecttipo').val('Por dia');
    var precio_hora = 0;
    var precio_dia = 0;
    var exist_cliente = false;
    var id_habitacion;

    $.ajax({
        method : "GET",
        url : "../procesos/habitaciones/habitacionReserva.php",
    }).done(function(msg) {
        var dato=JSON.parse(msg);
        console.log(dato);
    });

    $(document).on('click', '.pill', function() {
        var id = this.id;
        var val = this.value;

        $.ajax({
            method : "GET",
            url : "../procesos/habitaciones/traerDatos.php",
            data:'id='+id
        }).done(function(msg) {
            var dato=JSON.parse(msg);

            $('#lblnumero').html('Habitación: #'+dato['numero']);
            $('#lbltipo').html('Tipo Habitación: '+dato['tipo_habitacion']);
            $('#descrip').html(dato['descripcion'])
            var total = dato['precio'];
            var subtotal = dato['precio']-(dato['precio']*16/100);
            var ivatotal = dato['precio']*16/100;
            precio_hora = dato['precio_hora']
            precio_dia = dato['precio']
            id_habitacion =  dato['id']
            $('#txtsubtotal').val(subtotal);
            $('#txttotaliva').val(ivatotal);
            $('#txttotal').val(total);

        });

    });

    $(document).on('click', '#search', function() {
        var cedula = $("#txtcedula").val();
        if(cedula != ''){

            $.ajax({
                method : "POST",
                url : "../procesos/clientes/buscar.php",
                data:'cedula='+cedula
            }).done(function(msg) {
                if(msg == 0){
                    $('#txtnombre').prop('disabled', false);
                    $('#txtapellido').prop('disabled', false);
                    $('#txttelefono').prop('disabled', false);
                    $('#txtdireccion').prop('disabled', false);

                    $('#txtid').val('');
                    $('#txtnombre').val('');
                    $('#txtapellido').val('');
                    $('#txttelefono').val('');
                    $('#txtdireccion').val('');
                    
                    alertify.error("Cliente no encontrado!");

                }else{
                    var dato=JSON.parse(msg);
                    $('#txtid').val(dato['id']);
                    $('#txtnombre').val(dato['nombre']);
                    $('#txtapellido').val(dato['apellido']);
                    $('#txttelefono').val(dato['telefono']);
                    $('#txtdireccion').val(dato['direccion']);

                    $('#txtnombre').prop('disabled', true);
                    $('#txtapellido').prop('disabled', true);
                    $('#txttelefono').prop('disabled', true);
                    $('#txtdireccion').prop('disabled', true);
                    alertify.success("Cliente encontrado!");
                    exist_cliente = true;
                }
            });
        }else{
            alertify.error("Ingresa la cedula del cliente para buscarla!");
        }

    });

    $(document).on('click', '.nonreserva', function() {
        var val = this.value;

        alertify.error("La Habitación está en "+val+", no puedes reservar!");

    });

    $(document).on('click', '.reservada', function() {
        var val = this.value;
        var id = this.id;

        $.ajax({
            method : "GET",
            url : "../procesos/habitaciones/traerDatos.php",
            data:'id='+id
        }).done(function(msg) {
            var dato=JSON.parse(msg);

            $('#lblnumero2').html('Habitación: #'+dato['numero']);
            $('#lbltipo2').html('Tipo Habitación: '+dato['tipo_habitacion']);
            $('#descrip2').html(dato['descripcion'])   
        
        });
    });

    

    $('#selecttipo').on('change', function() {
        var val = $(this).val();
        if(val == 'Por hora'){
            if (precio_hora == 0){
                alertify.error("La Habitación no puede reservarse ya que su precio por hora es 0");
            }else{
                var total = precio_hora;
                var subtotal = precio_hora-(precio_hora*16/100);
                var ivatotal = precio_hora*16/100;
                $('#txtsubtotal').val(subtotal);
                $('#txttotaliva').val(ivatotal);
                $('#txttotal').val(total);
                $('#txtfechac').prop('disabled', false);
                $('#txthoras').prop('disabled', false);
                $('#txthoras').val(1);

            }
            

        }else{
            var total = precio_dia;
            var subtotal = precio_dia-(precio_dia*16/100);
            var ivatotal = precio_dia*16/100;
            $('#txtsubtotal').val(subtotal);
            $('#txttotaliva').val(ivatotal);
            $('#txttotal').val(total);
            $('#txtfechac').prop('disabled', true);
            $('#txthoras').prop('disabled', true);
            $('#txthoras').val();
        }
        
    });

    function updatePrice() {
        var num = parseInt($("#txthoras").val());
        var total = precio_hora*num;
        var subtotal = total-(total*16/100);
        var ivatotal = total*16/100;
        $('#txtsubtotal').val(subtotal);
        $('#txttotaliva').val(ivatotal);
        $('#txttotal').val(total);
        
    }

    $(document).on("change, keyup, input", "#txthoras", updatePrice);

    $('#selecttipohabitacion').on('change', function() {
        var val = $(this).val();
        listHabitaciones();
    });

    $('#selectestadohabitacion').on('change', function() {
        var val = $(this).val();
        listHabitaciones();
    });

    $(document).on('click', '#btnregistrar', function() {
        console.log('--->')
        
        var id_cliente = $("#txtid").val();
        var cedula = $("#txtcedula").val();
        var nombre = $("#txtnombre").val();
        var apellido = $("#txtapellido").val();
        var telefono = $("#txttelefono").val();
        var direccion = $("#txtdireccion").val();
        var tipo_reserva = $("#selecttipo").val();
        var horas = 0;
        if($("#txthoras").val() != '') {
            horas = $("#txthoras").val();
        }
        var fechai = $("#txtfechai").val();
        var fechac = $("#txtfechac").val();
        var total = $("#txttotal").val();


        if(exist_cliente == true){

            if(id_cliente != '' || tipo_reserva != '' || fechai != '' || fechac != '' || total != ''){
                datos = {
                    'id_habitacion' : id_habitacion, 'id_cliente': id_cliente, 'tipo_reserva': tipo_reserva, 'horas': horas, 
                    'fechai': fechai, 'fechac': fechac, 'total': total, 'accion': 'save'
                }
                console.log(datos);
                $.ajax({
                    method : "POST",
                    url : "../procesos/reserva/funciones.php",
                    data: datos
                }).done(function(msg) {
                    listHabitaciones();
                    alertify.confirm('Agregar Acompañantes', '¿Esta seguro que desea agregar acompañantes?', function()
                    {
                        
                    }, function(){});

                });
            }else{
                alertify.error("Debes llenar los datos");

            }
        }else{

            if(id_cliente != '' || tipo_reserva != '' || fechai != '' || fechac != '' || total != '' ||
                nombre != '' || apellido != '' || telefono != '' || direccion != '' || cedula != ''
            ){
                datos = {
                    'id_habitacion' : id_habitacion, 'id_cliente': id_cliente, 'tipo_reserva': tipo_reserva, 'horas': horas, 
                    'fechai': fechai, 'fechac': fechac, 'total': total, 
                    'nombre': nombre, 'apellido': apellido, 'telefono': telefono, 'direccion': direccion, 'cedula': cedula,
                    'accion': 'save'
                }
                console.log(datos);
                $.ajax({
                    method : "POST",
                    url : "../procesos/reserva/funciones.php",
                    data: datos
                }).done(function(msg) {
                    listHabitaciones();
                });
            }else{
                alertify.error("Debes llenar los datos");

            }

        }

        


    });


    function listHabitaciones(){
        datos = {
                    'estado' : $('#selectestadohabitacion').val(), 
                    'tipo': $('#selecttipohabitacion').val(),
                    'accion': 'habitaciones'
                }

        $.ajax({
            method : "GET",
            url : "../procesos/reserva/funciones.php",
            data: datos
        }).done(function(msg) {
            $("#listhabitaciones").empty();
            $("#listhabitaciones").append(msg);
            

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
