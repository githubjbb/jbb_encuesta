<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function(){
        $(".btn-primary").click(function () {   
                var oID = $(this).attr("id");
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'dashboard/cargarModalVentanillaBuscar',
                    data: {'idLink': oID},
                    cache: false,
                    success: function (data) {
                        $('#tablaDatos').html(data);
                    }
                });
        });
        $(".btn-info").click(function () {   
                var oID = $(this).attr("id");
                $.ajax ({
                    type: 'POST',
                    url: base_url + 'dashboard/cargarModalVentanillaBuscarRango',
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
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-10">
                            <i class="fa fa-list-ul"></i> <strong>LISTADO DE FORMULARIOS VENTANILLA VIRTUAL </strong> - <?php echo ucfirst(strftime("%b %d, %G",strtotime(date('Y-m-d')))); ?>
                        </div>
                        <div class="col-lg-2">
                            <form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaFormularioVentanillaFechaXLS"); ?>" target="_blank">
                                <input type="hidden" class="form-control" id="bandera" name="bandera" value=1 />
                                <input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" />
                            <?php
                                if($listaFormularios){ 
                            ?>
                            <div align="right">
                                <button type="submit" class="btn btn-violeta btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
                                    Descargar Registros - XLS <span class="fa fa-file-excel-o" aria-hidden="true" />
                                </button>
                            </div>
                            <?php
                                }
                            ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                <?php
                    if(!$listaFormularios){ 
                ?>
                        <div class="col-lg-12">
                            <small>
                                <p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay Formularios para hoy.</p>
                            </small>
                        </div>
                <?php
                    }else{
                ?>                      
                    <table width="100%" class="table table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Tipo Persona</th>
                                <th class="text-center">Razón Social</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Archivo</th>
                                <th class="text-center">Anexos</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 1;
                            foreach ($listaFormularios as $lista):
                                echo '<tr>';
                                echo '<td class="text-center">' . $i . '</td>';
                                echo '<td class="text-center">' . $lista['fecha_registro'] . '</td>';
                                echo '<td class="text-center">' . $lista['tipo_persona'] . '</td>';
                                echo '<td class="text-center">' . $lista['razon_social'] . '</td>';
                                echo '<td class="text-center">' . $lista['nombres'] . ' ' . $lista['apellidos'] . '</td>';
                                if ($lista['archivo'] != '') {
                                ?>
                                    <td class="text-center"><a href="<?php echo base_url("files/ventanilla/". $lista['archivo']); ?>" download="<?php echo $lista['archivo']; ?>" class="btn btn-success btn-sm"><span class="fa fa-download"></span></a></td>
                                <?php
                                } else {
                                    echo '<td></td>';
                                }
                                if ($lista['anexos'] != '') {
                                ?>
                                    <td class="text-center"><a href="<?php echo base_url("files/ventanilla/". $lista['anexos']); ?>" download="<?php echo $lista['anexos']; ?>" class="btn btn-success btn-sm"><span class="fa fa-download"></span></a></td>
                                <?php
                                } else {
                                    echo '<td></td>';
                                }
                                echo '</tr>';
                                $i++;
                            endforeach;
                        ?>
                        
                        </tbody>
                    </table>
                    <?php } ?>                    
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-violeta">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> FORMULARIOS
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item" disabled>
                            <p class="text-info"><i class="fa fa-tag fa-fw"></i><strong> No. Formularios Hoy</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noFormulariosHOY; ?></em>
                                </span>
                            </p>
                        </a>
                        <a href="#" class="list-group-item" disabled>
                            <p class="text-success"><i class="fa fa-tag  fa-fw"></i><strong> No. Formularios esta Semana</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noFormulariosSEMANA; ?></em>
                                </span>
                            </p>
                        </a>
                        <a href="#" class="list-group-item" disabled>
                            <p class="text-danger"><i class="fa fa-tag  fa-fw"></i><strong> No. Formularios este Mes</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noFormulariosMES; ?></em>
                                </span>
                            </p>
                        </a>
                    </div>
                    <div class="list-group">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal" id="x">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar Encuestas por Fecha
                        </button>
                        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modalRango" id="y">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar Formularios por Rango
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