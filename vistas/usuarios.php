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
        <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">          
           <div class="col-lg-12">
           <form id="frmregistrar">
            <label>Usuario (*)</label>
            <input type="text" class="form-control" id="txtusuario" name="txtusuario">
            <label>Tipo Usuario (*)</label>
            <select class="form-control" id="selecttipousuario">
                <option value="0">--Seleccione--</option>
                <?php
                    require_once '../clases/TipoUsuario.php';
                    require_once '../clases/Conexion.php';
                    $obj = new TipoUsuario();
                    $result = $obj->mostrar();
                    while($fila=mysqli_fetch_row($result)){
                ?>
                    <option value="<?php echo $fila[0]?>"><?php echo $fila[1]?></option>
                <?php }?>
            </select>
            <label>Clave (*)</label>
            <input type="password" class="form-control" id="txtclave" name="txtclave">
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
        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
           
           <div class="col-lg-12">
           <form id="frmeditar">
            <label>Usuario (*)</label>
            <input type="text" class="form-control" id="txtusuarioe" disabled>
            <label>Tipo Usuario (*)</label>
            <select class="form-control" id="selecttipousuarioe">
                <option value="0">--Seleccione--</option>
                <?php
                    require_once '../clases/TipoUsuario.php';
                    require_once '../clases/Conexion.php';
                    $obj = new TipoUsuario();
                    $result = $obj->mostrar();
                    while($fila=mysqli_fetch_row($result)){
                ?>
                    <option value="<?php echo $fila[0]?>"><?php echo $fila[1]?></option>
                <?php }?>
            </select>
            <label>Clave (*)</label>
            <input type="password" class="form-control" id="txtclavee" name="txtclavee">
            <label>Tipo Usuario (*)</label>
            <select class="form-control" id="selectestadoe">
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
                                                <h1 class="main-title float-left">Usuarios</h1>
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
                                    <td>Usuario</td>
                                    <td>Tipo Usuario</td>
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
            "url":"../procesos/usuarios/mostrar.php",
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
                
                "data":"usuario"
            },
            {
                
                "data":"tipo_usuario"
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
                        url : "../procesos/usuarios/traer.php",
                        data:'id='+id
                    }).done(function(msg) {
                        var dato=JSON.parse(msg);
				        $('#txtusuarioe').val(dato['usuario']);
                        $('#txtclavee').val(dato['clave']);
                        $('#selecttipousuarioe').val(dato['id_tipo_usuario']);
                        $('#selectestadoe').val(dato['estatus']);
                        
                        $('#btneditar').unbind().click(function(){
                            
                            usuario = $('#txtusuarioe').val();
                            clave = $('#txtclavee').val();
                            tipousuario = $('#selecttipousuarioe').val();
                            estatus = $('#selectestadoe').val();
                            if(usuario.length != 0 || clave.length != 0 || tipousuario.length != 0)
                            {
                             datos = {
                                'id': id,
                                'txtusuario': $('#txtcedulae').val(),
                                'txtclave': $('#txtclavee').val(),
                                'txttipousuario': $('#selecttipousuarioe').val(),
                                'txtestatus': $('#selectestadoe').val(),
                            }
                            //alert(oka);
                            //alert(JSON.stringify(oka));
                            $.ajax({
                                method : "POST",
                                //contentType: 'application/json; charset=utf-8',
                                url : "../procesos/usuarios/editar.php",
                                data : datos
                                }).done(function(msg) {
                                alertify.success("Usuario Editado Correctamente!");
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
            
            alertify.confirm('Eliminar Usuario', '¿Esta seguro que desea eliminar este Habitación?', function()
                {
                        $.ajax({
                                type:"POST",
                                url : "../procesos/usuarios/eliminar.php",
                                data : "id="+id
                            }).done(function(msg) {
                                alertify.success("Usuario Eliminado Correctamente");
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
       usuario = $('#txtusuario').val();
       clave = $('#txtclave').val();
       tipousuario = $('#selecttipousuario').val();
        if(usuario.length != 0 || clave.length != 0 || tipousuario.length != 0){

            $.get( '../procesos/funciones.php?accion=existUsuario&usuario='+usuario, function(result){
                if(result == 0){
                    datos = {
                        'txtusuario': usuario,
                        'txtclave': clave,
                        'txttipousuario': tipousuario,
                    }
                    $.ajax({
                    type:'post',
                        url:'../procesos/usuarios/registrar.php',
                        data:datos,
                        success:function(r)
                        {
                            
                            if(r==1)
                                {
                                    alertify.success("Usuario Registrado Correcamente");
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
                        }
                    });

                }else{
                    alertify.error("Usuario ya existe");
                }
            });
            
            }
        else{
            alertify.error("Complete los datos");
        }
    });
});
</script>
