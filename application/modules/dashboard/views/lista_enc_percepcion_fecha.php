<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<a class="btn btn-success btn-xs" href=" <?php echo base_url('dashboard/admin_percepcion'); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Dashboard </a> 
					<i class="fa fa-list-ul"></i> <strong>RESGISTROS ENCUESTA DE PERCEPCIÓN</strong>
				</div>
				<div class="panel-body">
				<?php 
					//si la consulta es por fecha
					if($bandera){
				?>
					<div class="alert alert-success">
						<div class="row">
							<div class="col-lg-10">
								<strong>Fecha: </strong>
								<?php echo ucfirst(strftime("%b %d, %G",strtotime($fecha))); ?>
							</div>
							<?php if($listaEncuestas){ ?>
							<div class="col-lg-2">
								<form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaEncuestaPercepcionFechaXLS"); ?>" target="_blank">
									<input type="hidden" class="form-control" id="bandera" name="bandera" value=1 />
									<input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha ?>" />
									<div align="right">
										<button type="submit" class="btn btn-primary btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
										Descargar Registros - XLS <span class="fa fa-file-excel-o" aria-hidden="true" />
										</button>
									</div>
								</form>
							</div>
							<?php } ?>
						</div>
					</div>
				<?php
					} else {
					//si la consulta es por rango de fechas
				?>
					<div class="alert alert-success">
						<div class="row">
							<div class="col-lg-10">
								<strong>Rango de Fechas: </strong>
								<?php 
									echo ucfirst(strftime("%b %d, %G",strtotime($from))); 
									echo ' - ';
									echo ucfirst(strftime("%b %d, %G",strtotime($to))); 
								?>
							</div>
							<?php if($listaEncuestas){ ?>				
							<div class="col-lg-2">
								<form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaEncuestaPercepcionFechaXLS"); ?>" target="_blank">
									<input type="hidden" class="form-control" id="bandera" name="bandera" value=2 />
									<input type="hidden" class="form-control" id="from" name="from" value="<?php echo $from; ?>" />
									<input type="hidden" class="form-control" id="to" name="to" value="<?php echo $to; ?>" />
									<div align="right">
										<button type="submit" class="btn btn-primary btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
										Descargar Registros - XLS <span class="fa fa-file-excel-o" aria-hidden="true" />
										</button>
									</div>
								</form>
							</div>
							<?php } ?>
						</div>
					</div>
				<?php
					}
				    if(!$listaEncuestas){ 
				?>
				        <div class="col-lg-12">
				            <small>
				                <p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en la base de datos.</p>
				            </small>
				        </div>
				<?php
				    } else {
				?>
					<table width="100%" class="table table-hover" id="dataTables">
						<thead>
							<tr>
                                <th class='text-center'>#</th>
                                <th class='text-center'>Fecha</th>
                                <th class='text-center'>Localidad</th>
                                <th class='text-center'>Estrato</th>
                                <th class='text-center'>Genero</th>
                                <th class='text-center'>Grupo étnico</th>
                                <th class='text-center'>Rango de edad</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							$i = 1;
							foreach ($listaEncuestas as $lista):
                                echo '<tr>';
                                echo '<td class="text-center">' . $i . '</td>';
                                echo '<td class="text-center">' . $lista['fecha_registro'] . '</td>';
                                echo '<td class="text-center">' . $lista['localidad'] . '</td>';
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
                                echo '</td>';
                                echo '<td class="text-center">' . $lista['grupo_etnico'] . '</td>';
                                echo '<td class="text-center">' . $lista['rango_edades'] . '</td>';
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
	</div>
</div>

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