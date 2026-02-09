<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{



?>



<!-- Modal registrar -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Habitación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
           
           <div class="col-lg-12">
           <form id="frmregistrar">
            <label>Numero <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="txtnumero" name="txtnumero">
            <label>Descripcion <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="txtdescripcion" name="txtdescripcion">
            <label>Tipo habitacion <span style="color: red;">*</span></label>
            <select class="form-control" id="selecttipohabitacion">
                <option value="0">--Seleccione--</option>
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
            <input type="hidden" class="form-control" id="txttipohabitacion">
            <label>Estado habitacion <span style="color: red;">*</span></label>
            <select class="form-control" id="selectestadohabitacion">
                <option value="0">--Seleccione--</option>
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
            <input type="hidden" class="form-control" id="txtestadohabitacion">
            <label>Precio 24 horas <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="txtprecio" name="txtprecio" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            <label>Precio 1 hora <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="txtpreciohora" name="txtpreciohora" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            <label>Maximo de personas <span style="color: red;">*</span></label>
            <input type="number" class="form-control" id="txtmaxpersona" name="txtmaxpersona" value='1' min='1'>
            </form>
            <div>
                <span style="color: red;">(*) Requerido</span>
            </div>
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
    
    


<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Habitación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
           
           <div class="col-lg-12">
           <label>Numero <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="txtnumeroe" name="txtnumero">
            <label>Descripcion <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="txtdescripcione" name="txtdescripcion">
            <label>Tipo habitacion <span style="color: red;">*</span></label>
            <select class="form-control" id="selecttipohabitacione">
                <option value="0">--Seleccione--</option>
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
            <input type="hidden" class="form-control" id="txttipohabitacione">
            <label>Estado habitacion <span style="color: red;">*</span></label>
            <select class="form-control" id="selectestadohabitacione">
                <option value="0">--Seleccione--</option>
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
            <input type="hidden" class="form-control" id="txtestadohabitacione">
            <label>Precio 24 horas <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="txtprecioe" name="txtprecio" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            <label>Precio 1 hora <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="txtpreciohorae" name="txtpreciohora" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            <label>Maximo de personas <span style="color: red;">*</span></label>
            <input type="number" class="form-control" id="txtmaxpersonae" name="txtmaxpersonae" min='1'>
            <label>Estatus <span style="color: red;">*</span></label>
            <select class="form-control" id="selectestatuse">
                <option value="A">Activo</option>
                <option value="I">Inctivo</option>
            </select>
            <input type="hidden" class="form-control" id="txtestatuse" >
            <div>
                <span style="color: red;">(*) Requerido</span>
            </div>
        </div>
            
           
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btneditar" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
    
      

    <div class="content-page">
	
    <!-- Start content -->
    <div class="content">
        
        <div class="container-fluid">
                
                    <div class="row">
                                <div class="col-xl-12">
                                        <div class="breadcrumb-holder">
                                                <h1 class="main-title float-left">Habitación</h1>
                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                 Registrar
                                                </button>
                                                <div class="clearfix">
                                                
                                                </div>
                                        </div>
                                </div>
                    </div>
                    <!-- end row -->
                    <div class="row">
                       <!-- Button trigger modal -->
                       
                        <div class="col-lg-12">
                        <table  id="myTable" class="table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Numero</td>
                                    <td>Estado</td>
                                    <td>Tipo Habitación</td>
                                    <td>Precio/dia</td>
                                    <td>Precio/hora</td>
                                    <td>Estatus</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                        </div>
                        
                    </div>



        </div>
        <!-- END container-fluid -->

    </div>
    <!-- END content -->

</div>
<!-- END content-page -->



<?php
require 'footer.php';
}
else {
	header("location:../index.php");  
}

?>


<script>
$(document).ready(function(){
    
    var table = $('#myTable').DataTable({
        "ajax":{
            "url":"../procesos/habitaciones/mostrar.php",
            "type":"GET"
            //"crossDomain": "true",
            //"dataType": "json",
            //"dataSrc":""
        },
        "columns":[
            {
                "data":"id"
            },
            {
                
                "data":"numero"
            },
            {
                
                "data":"estado"
            },
            {
                "data":"tipo_habitacion"
            },
            {
                
                "data":"precio"
            },
             {
                
                "data":"precio_hora"
            },
            {
                
                "data":"estatus"
            },
            {
                sTitle: "Eliminar",
                mDataProp: "id",
                sWidth: '7%',
                orderable: false,
                render: function(data) {
                    acciones = `<button id="` + data + `" value="Eliminar"  type="button" class="fa fa-times btn btn-danger accionesTabla" >
                                    
                                </button>`;
                    return acciones
                }
            },
            {
                sTitle: "Editar",
                mDataProp: "id",
                sWidth: '7%',
                orderable: false,
                render: function(data) {
                    acciones = `<button id="` + data + `" value="Traer" class="fa fa-pencil-square-o btn btn-primary accionesTabla" data-toggle="modal" data-target="#exampleModal2" type="button"  >
                                    
                                </button>`;
                    return acciones
                }
            }
        ],
        responsive:true,
                "ordering": false


    });
    
$(document).on('click', '.accionesTabla', function() {
    var id = this.id;
    var val = this.value;

    switch (val) {
        case "Traer":
                    $.ajax({
                        method : "GET",
                        url : "../procesos/habitaciones/traer.php",
                        data:'id='+id
                    }).done(function(msg) {
                        var dato=JSON.parse(msg);
				        $('#txtnumeroe').val(dato['numero']);
                        $('#txtdescripcione').val(dato['descripcion']);
                        $('#txtprecioe').val(dato['precio']);
                        $('#selectestadohabitacione').val(dato['id_estado_habitacion']);
                        $('#selecttipohabitacione').val(dato['id_tipo_habitacion']);
                        $('#txtpreciohorae').val(dato['precio_hora']);
                        $('#selectestatuse').val(dato['estatus']);
                        $('#txtmaxpersonae').val(dato['maxpersona']);

                        $('#btneditar').unbind().click(function(){                         
                            numero = $('#txtnumeroe').val();
                            desc = $('#txtdescripcione').val();
                            precio = $('#txtprecioe').val();
                            estado = $('#txtestadohabitacione').val();
                            tipo = $('#txttipohabitacione').val();
                            precio_hora = $('#txtpreciohorae').val();

                            if(numero.length != 0 || desc.length != 0 || precio.length != 0 || estado.length != 0 ||
                                tipo.length != 0 || precio_hora.length != 0 
                            )
                                {
                                datos = {
                                        'id' : id,
                                        'txtnumero' : $('#txtnumeroe').val(), 
                                        'txtdescripcion': $('#txtdescripcione').val(),
                                        'txtprecio': $('#txtprecioe').val(), 
                                        'txtpreciohora': $('#txtpreciohorae').val(),
                                        'txtestadohabitacion': $('#selectestadohabitacione').val(),
                                        'txttipohabitacion': $('#selecttipohabitacione').val(), 
                                        'txtestatus': $('#selectestatuse').val(), 
                                        'txtmaxpersona' : $('#txtmaxpersonae').val(),
                                    }
                            
                            $.ajax({
                                method : "POST",
                                //contentType: 'application/json; charset=utf-8',
                                url : "../procesos/habitaciones/editar.php",
                                data : datos
                                }).done(function(msg) {
                                alertify.success("Habitación Editada Correctamente!");
                                table.ajax.reload();
                                });                               
                                    
                                }
                            else{
                                alertify.error("Complete los datos");
                            }

                        });
                    });
            break;
        case "Eliminar":
            
            alertify.confirm('Eliminar Habitación', '¿Esta seguro que desea eliminar este Habitación?', function()
                {
                        $.ajax({
                                type:"POST",
                                url : "../procesos/habitaciones/eliminar.php",
                                data : "id="+id
                            }).done(function(msg) {
                                alertify.success("Habitación Eliminado Correctamente");
                                table.ajax.reload();
                            });
                }
                , function(){
                
                });



        
                    break;
        default:
            alert("No existe el valor");
            break;
    }
    });    
    
    
    
    $('#btnregistrar').click(function(){
        numero = $('#txtnumero').val();
        desc = $('#txtdescripcion').val();
        precio = $('#txtprecio').val();
        estado = $('#txtestadohabitacion').val();
        tipo = $('#txttipohabitacion').val();
        precio_hora = $('#txtpreciohora').val();
        
        if(numero.length != 0 && desc.length != 0 && precio.length != 0 && estado.length != 0 &&
            tipo.length != 0 && precio_hora.length != 0 
        )
        {
            datos = {
                    'txtnumero' : $('#txtnumero').val(), 
                    'txtdescripcion': $('#txtdescripcion').val(),
                    'txtprecio': $('#txtprecio').val(), 
                    'txtpreciohora': $('#txtpreciohora').val(),
                    'txtestadohabitacion': $('#txtestadohabitacion').val(),
                    'txttipohabitacion': $('#txttipohabitacion').val(), 
                    'txtmaxpersona' : $('#txtmaxpersona').val(),
                }

            $.ajax({
               type:'post',
                url:'../procesos/habitaciones/registrar.php',
                data:datos,
                success:function(r)
                {
                    
                    if(r==1)
                        {
                            alertify.success("Habitacióon Registrada Correcamente");
                            table.ajax.reload();
                        }
                    else if(r==0)
                        {
                            alertify.error("No se pudo registrar");
                        }
                    else
                        {
                            alert(r);
                        }
                    limpiar();
                }
            });
            }
        else{
            alertify.error("Complete los datos");
        }
    });

    $('#selecttipohabitacion').on('change', function() {
        var val = $(this).val();
        $('#txttipohabitacion').val(val);
    });

    $('#selectestadohabitacion').on('change', function() {
        var val = $(this).val();
        $('#txtestadohabitacion').val(val);
    });

    function limpiar(){
        $('#txtnumero').val('');
        $('#txtdescripcion').val('');
        $('#txtprecio').val(''); 
        $('#txtpreciohora').val('');
        $('#txtestadohabitacion').val('');
        $('#txttipohabitacion').val(''); 
        $('#txtmaxpersona').val('');
    }
});
</script>
