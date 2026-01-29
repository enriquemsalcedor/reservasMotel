<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{



?>
   
    <div class="content-page">
	
    <!-- Start content -->
    <div class="content">
        
        <div class="container-fluid">
                
                    <div class="row">
                                <div class="col-xl-12">
                                        <div class="breadcrumb-holder">
                                                <h1 class="main-title float-left">Respaldo</h1>
                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button"  class="btn btn-primary" data-toggle="modal" id="generar">
                                                 Respaldo
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
                        <table  id="list" class="table">
                            
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
    list();

    $(document).on("click", "#generar", generar);


    function generar(){

        $.ajax({
            method : "GET",
            url : "../procesos/funciones.php?accion=aggrespaldos",
            
        }).done(function(msg) {
            if(msg == 1){
                list(); 

            }
                       

        });

    }
    function respaldo(){

        $.ajax({
            method : "GET",
            url : "../procesos/seguridad/respaldo.php",
            
        }).done(function(msg) {
            if(msg == 1){
                list(); 
                
            }
                       

        });

    }

    function list(){

        $.ajax({
            method : "POST",
            url : "../procesos/funciones.php?accion=respaldos",
            //data: 'accion: respaldos'
        }).done(function(msg) {
            $("#list").empty();
            $("#list").append(msg);
            

        });

    }
    
});
</script>
