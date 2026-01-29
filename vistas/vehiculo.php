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
        <h5 class="modal-title" id="exampleModalLabel">Registrar Vehiculo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
           
           <div class="col-lg-12">
           <form id="frmregistrar">
            <label>Cliente (*)</label>
            <select class="form-control" id="selectcliente">
                <option value="0">--Seleccione--</option>
                <?php
                    require_once '../clases/Vehiculo.php';
                    require_once '../clases/Conexion.php';
                    $obj = new Vehiculo();
                    $result = $obj->clientesReserva();
                    while($fila=mysqli_fetch_row($result)){
                ?>
                    <option value="<?php echo $fila[0]?>"><?php echo $fila[1]?></option>
                <?php }?>
            </select>
            <label>Placa</label>
            <input type="text" class="form-control" id="txtplaca">
            <label>Modelo</label>
            <input type="text" class="form-control" id="txtmodelo">
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

    <div class="content-page">
	
    <!-- Start content -->
    <div class="content">
        
        <div class="container-fluid">
                
                    <div class="row">
                                <div class="col-xl-12">
                                        <div class="breadcrumb-holder">
                                                <h1 class="main-title float-left">Vehiculos</h1>
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
                                    <td>Cliente</td>
                                    <td>Placa</td>
                                    <td>Modelo</td>
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
            "url":"../procesos/vehiculos/mostrar.php",
            "type":"GET"
            //"crossDomain": "true",
            //"dataType": "json",
            //"dataSrc":""
        },
        "columns":[
            {
                
                "data":"cliente"
            },
            {
                
                "data":"placa"
            },
            {
                "data":"modelo"
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
           
        ],
        responsive:true,
                "ordering": false


    });
    
$(document).on('click', '.accionesTabla', function() {
    var id = this.id;
    var val = this.value;

    switch (val) {
        case "Eliminar":
            
            alertify.confirm('Eliminar Vehiculo', '¿Esta seguro que desea eliminar este Vehiculo?', function()
                {
                        $.ajax({
                                type:"POST",
                                url : "../procesos/vehiculos/eliminar.php",
                                data : "id="+id
                            }).done(function(msg) {
                                alertify.success("Vehiculo Eliminado Correctamente");
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
        cliente = $('#selectcliente').val();
        placa = $('#txtplaca').val();
        modelo = $('#txtmodelo').val();
        sesion = $('#session').val();
       
               
        if(cliente.length != 0 || placa.length != 0 || modelo.length != 0)
            {
            datos = {
                    'cliente' : cliente, 
                    'placa': placa,
                    'modelo': modelo, 
                    'sesion': sesion
                }
            $.ajax({
               type:'post',
                url:'../procesos/vehiculos/registrar.php',
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
                    $('#txtplaca').val('');
                    $('#txtmodelo').val('');
                    $('#selectcliente').val('');
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
});
</script>
