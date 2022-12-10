<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function(){ 
    $(".btn-primary").click(function () {   
            var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
                url: base_url + 'dashboard/cargarModalBuscar',
                data: {'idLink': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
    }); 
});
</script>

<script>
$(function(){ 
    $(".btn-info").click(function () {   
            var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
                url: base_url + 'dashboard/cargarModalBuscarRango',
                data: {'idLink': oID},
                cache: false,
                success: function (data) {
                    $('#formRango').html(data);
                }
            });
    }); 
});
</script>

<div id="page-wrapper">
    <div class="row"><br>
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						DASHBOARD
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
    </div>
								
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-6">
                        <i class="fa fa-list-ul"></i> <strong>LISTADO DE ENCUESTAS DE SATISFACCIÓN </strong> -  <?php echo ucfirst(strftime("%b %d, %G",strtotime(date('Y-m-d')))); ?>
                        </div>
                        <div class="col-lg-2">
                            <form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaReservaFechaXLS"); ?>" target="_blank">
                                <input type="hidden" class="form-control" id="bandera" name="bandera" value=1 />
                                <input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" />

                            <?php
                                if($listaFormularios){ 
                            ?>
                                <button type="submit" class="btn btn-violeta btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
                                    Descargar Registros - XLS <span class="fa fa-file-excel-o" aria-hidden="true" />
                                </button>
                            <?php
                                }
                            ?>
                            </form>
                        </div>
                    </div>
                       
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

<?php
    if(!$listaFormularios){ 
?>
        <div class="col-lg-12">
            <small>
                <p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay Encuestas para hoy.</p>
            </small>
        </div>
<?php
    }else{
?>                      

                    <table width="100%" class="table table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th class='text-center'>#</th>
                                <th>Fecha</th>
                                <th>Rango edad</th>
                                <th class='text-center'>Genero</th>
                                <th>Localidad</th>
                                <th>Nombre servidor</th>
                            </tr>
                        </thead>
                        <tbody>                         
                        <?php
                            $i = 1;
                            foreach ($listaFormularios as $lista):
                                echo '<tr>';
                                echo '<td class="text-center">' . $i . '</td>';
                                echo '<td>' . $lista['fecha'] . '</td>';
                                echo "<td>";
                                switch ($lista['rango_edad']) {
                                    case 1:
                                        echo 'Menor a 26 años ';
                                        break;
                                    case 2:
                                        echo '27 a 59 años';
                                        break;
                                    case 3:
                                        echo 'Mayor de 60 años';
                                        break;
                                }
                                echo "</td>";
                                echo '<td class="text-center">';
                                switch ($lista['genero']) {
                                    case 1:
                                        echo 'Hombre';
                                        break;
                                    case 2:
                                        echo 'Mujer';
                                        break;
                                    case 3:
                                        echo 'No responde';
                                        break;
                                    case 4:
                                        echo 'Otro <br>';
                                        echo $lista['genero_otro']; 
                                        break;
                                }
                                echo "</td>";
                                echo '<td>' . $lista['localidad'] . '</td>';
                                echo '<td>' . $lista['nombre_servidor'] . '</td>';
                                echo '</tr>';
                                $i++;
                            endforeach;
                        ?>
                        </tbody>
                    </table>
                    
<?php   } ?>                    
                </div>
            </div>

        </div>

        <div class="col-lg-3">
            <div class="panel panel-violeta">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> ENCUESTAS
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item" disabled>
                            <p class="text-info"><i class="fa fa-tag fa-fw"></i><strong> No. Encuestas Hoy</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noFormulariosHOY; ?></em>
                                </span>
                            </p>
                        </a>

                        <a href="#" class="list-group-item" disabled>
                            <p class="text-success"><i class="fa fa-tag  fa-fw"></i><strong> No. Encuestas esta Semana</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noFormulariosSEMANA; ?></em>
                                </span>
                            </p>
                        </a>

                        <a href="#" class="list-group-item" disabled>
                            <p class="text-danger"><i class="fa fa-tag  fa-fw"></i><strong> No. Encuestas este Mes</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noFormulariosMES; ?></em>
                                </span>
                            </p>
                        </a>

                    </div>
                    <!-- /.list-group -->

                    <div class="list-group">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal" id="x">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar Encuestas por Fecha
                        </button>

                        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modalRango" id="y">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar Encuestas por Rango
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!--INICIO Modal Buscar por fecha -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="tablaDatos">

        </div>
    </div>
</div>                       
<!--FIN Modal Buscar por fecha -->

<!--INICIO Modal Buscar por fecha -->
<div class="modal fade text-center" id="modalRango" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="formRango">

        </div>
    </div>
</div>                       
<!--FIN Modal Buscar por fecha -->

<!-- Tables -->
<script>
$(document).ready(function() {
    $('#dataTables').DataTable({
        responsive: true,
         "ordering": false,
         paging: false,
        "searching": false,
        "info": false
    });
});
</script>