<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function(){ 
    $(".btn-info").click(function () {   
            var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
                url: base_url + 'dashboard/cargarModalPercepcionBuscarRango',
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
                        <div class="col-lg-12">
                        <i class="fa fa-list-ul"></i> <strong>LISTADO DE ENCUESTA DE PERCEPCIÓN SOBRE LA GESTIÓN DEL JARDÍN BOTÁNICO DE BOGOTÁ JOSÉ CELESTINO MUTIS </strong> -  <?php echo ucfirst(strftime("%b %d, %G",strtotime(date('Y-m-d')))); ?>
                            <br>
                            <form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaEncuestaPercepcionFechaXLS"); ?>" target="_blank">
                                <input type="hidden" class="form-control" id="bandera" name="bandera" value=1 />
                                <input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" />

                            <?php
                                if($listaEncuestas){ 
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
    if(!$listaEncuestas){ 
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
                                <th>Localidad</th>
                                <th class='text-center'>Estrato</th>
                                <th class='text-center'>Genero</th>
                                <th class='text-center'>Grupo étnico</th>
                                <th>Rango de edad</th>
                            </tr>
                        </thead>
                        <tbody>                         
                        <?php
                            $i = 1;
                            foreach ($listaEncuestas as $lista):
                                echo '<tr>';
                                echo '<td class="text-center">' . $i . '</td>';
                                echo '<td>' . $lista['fecha_registro'] . '</td>';
                                echo '<td>' . $lista['localidad'] . '</td>';
                                echo '<td class="text-center">' . $lista['estrato'] . '</td>';
                                echo '<td class="text-center">';
                                switch ($lista['genero']) {
                                    case 1:
                                        echo 'Hombre';
                                        break;
                                    case 2:
                                        echo 'Mujer';
                                        break;
                                    case 3:
                                        echo 'LGTBTI';
                                        break;
                                }
                                echo "</td>";
                                echo '<td class="text-center">' . $lista['grupo_etnico'] . '</td>';
                                echo '<td>' . $lista['rango_edades'] . '</td>';
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
                                <span class="pull-right text-muted small"><em><?php echo $noEncuestasHOY; ?></em>
                                </span>
                            </p>
                        </a>

                        <a href="#" class="list-group-item" disabled>
                            <p class="text-success"><i class="fa fa-tag  fa-fw"></i><strong> No. Encuestas esta Semana</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noEncuestasSEMANA; ?></em>
                                </span>
                            </p>
                        </a>

                        <a href="#" class="list-group-item" disabled>
                            <p class="text-danger"><i class="fa fa-tag  fa-fw"></i><strong> No. Encuestas este Mes</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noEncuestasMES; ?></em>
                                </span>
                            </p>
                        </a>

                    </div>
                    <!-- /.list-group -->

                    <div class="list-group">
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