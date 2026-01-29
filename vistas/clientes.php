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
        <h5 class="modal-title" id="exampleModalLabel">Registrar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
           
           <div class="col-lg-12">
           <form id="frmregistrar">
            <label>Cedula (*)</label>
            <div style="display:flex;">
                <div style="display: flex; width: 100%;">
                    <select name="" class="form-control" id="tipocliente" style="width: 15%; margin-right: 5px;">
                        <option value="V">V</option>
                        <option value="E">E</option>
                        <option value="J">J</option>
                        <option value="G">G</option>
                    </select>
                    <input type="text" class="form-control" id="txtcedula" name="txtcedula" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10">
                </div>
            </div>
            <label>Nombre (*)</label>
            <input type="text" class="form-control" id="txtnombre" name="txtnombre">
            <label>Apellido (*)</label>
            <input type="text" class="form-control" id="txtapellido" name="txtapellido">
            <label>Direccion</label>
            <input type="text" class="form-control" id="txtdireccion" name="txtdireccion">
            <label>Telefono</label>
            <input type="text" class="form-control" id="txttelefono" name="txttelefono" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11">
            </form>
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
        <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
           
           <div class="col-lg-12">
           <form id="frmeditar">
            <label>Cedula (*)</label>
            <div style="display: flex; width: 100%;">
                <select name="" class="form-control" id="tipoclientee" style="width: 15%; margin-right: 5px;" disabled>
                    <option value="V">V</option>
                    <option value="E">E</option>
                    <option value="J">J</option>
                    <option value="G">G</option>
                </select>
                <input type="text" class="form-control" id="txtcedulae" name="txtcedula" disabled>
            </div>
            <label>Nombre (*)</label>
            <input type="text" class="form-control" id="txtnombree" name="txtnombre">
            <label>Apellido (*)</label>
            <input type="text" class="form-control" id="txtapellidoe" name="txtapellido">
            <label>Direccion</label>
            <input type="text" class="form-control" id="txtdireccione" name="txtdireccion">
            <label>Telefono</label>
            <input type="text" class="form-control" id="txttelefonoe" name="txttelefono" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11">
            <label>Estatus</label>
            <select name="" class="form-control" id="txtestatuse">
                    <option value="A">Activo</option>
                    <option value="I">Inactivo</option>
                </select>
            </form>
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
                                                <h1 class="main-title float-left">Cliente</h1>
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
                                    <td>Cedula</td>
                                    <td>Nombre</td>
                                    <td>Apellido</td>
                                    <td>Telefono</td>
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
            "url":"../procesos/clientes/mostrar.php",
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
                
                "data":"cedula"
            },
            {
                
                "data":"nombre"
            },
            {
                "data":"apellido"
            },
            {
                "data":"telefono"
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
                        url : "../procesos/clientes/traer.php",
                        data:'id='+id
                    }).done(function(msg) {
                        var dato=JSON.parse(msg);
                        $('#tipoclientee').val(dato['tipo_cliente']);
				        $('#txtnombree').val(dato['nombre']);
                        $('#txtdireccione').val(dato['direccion']);
                        $('#txttelefonoe').val(dato['telefono']);
                        $('#txtapellidoe').val(dato['apellido']);
                        $('#txtcedulae').val(dato['cedula']);                        
                        $('#estatus').val(dato['estatus']);

                        $('#btneditar').unbind().click(function(){
                            
                            nom = $('#txtnombree').val();
                            ced = $('#txtcedulae').val();
                                if(nom.length != 0 || ced.length != 0)
                                    {
                             datos = {
                                'id': id,
                                'txttipocliente': $('#tipoclientee').val(),
                                'txtcedula': $('#txtcedulae').val(),
                                'txtnombre': $('#txtnombree').val(),
                                'txtapellido': $('#txtapellidoe').val(),
                                'txttelefono': $('#txttelefonoe').val(),
                                'txtdireccion': $('#txtdireccione').val(),
                                'txtestatus': $('#txtestatuse').val(),
                            }
                            //alert(oka);
                            //alert(JSON.stringify(oka));
                            $.ajax({
                                method : "POST",
                                //contentType: 'application/json; charset=utf-8',
                                url : "../procesos/clientes/editar.php",
                                data : datos
                                }).done(function(msg) {
                                alertify.success("Cliente Editado Correctamente!");
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
            
            alertify.confirm('Eliminar Cliente', '¿Esta seguro que desea eliminar este Cliente?', function()
                {
                        $.ajax({
                                type:"POST",
                                url : "../procesos/clientes/eliminar.php",
                                data : "id="+id
                            }).done(function(msg) {
                                alertify.success("Cliente Eliminado Correctamente");
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
       nom = $('#txtnombre').val();
       ced = $('#txtcedula').val();
       tip = $('#tipocliente').val();
        $.get( '../procesos/funciones.php?accion=existCliente&cedula='+ced+'&tipo='+tip, function(result){
            if(result == 0){
                if(nom.length != 0 || ced.length != 0){
                    datos = {
                        'txtitpocliente': $('#tipocliente').val(),
                        'txtcedula': $('#txtcedula').val(),
                        'txtnombre': $('#txtnombre').val(),
                        'txtapellido': $('#txtapellido').val(),
                        'txttelefono': $('#txttelefono').val(),
                        'txtdireccion': $('#txtdireccion').val(),
                    }
                    $.ajax({
                    type:'post',
                        url:'../procesos/clientes/registrar.php',
                        data:datos,
                        success:function(r)
                        {
                            
                            if(r==1)
                                {
                                    alertify.success("Cliente Registrado Correcamente");
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

            }else{
                alertify.error("Cliente ya existe");
            }
        })
    });

    function limpiar(){
        $('#tipocliente').val('V');
        $('#txtcedula').val('');
        $('#txtnombre').val('');
        $('#txtapellido').val('');
        $('#txttelefono').val('');
        $('#txtdireccion').val('');
    }
});
</script>
