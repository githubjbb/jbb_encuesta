<div id="page-wrapper">
	<br>

	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<a class="btn btn-success btn-xs" href=" <?php echo base_url('dashboard/admin'); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Dashboard </a> 
					<i class="fa fa-list-ul"></i> <strong>RESGISTROS ENCUESTA DE SATISFACCIÓN</strong>
				</div>
				<div class="panel-body">
				<?php 
					//si la consulta es por fecha
					if($bandera){
				?>
					<div class="alert alert-success">
						<div class="row">
							<div class="col-lg-2">
								<strong>Fecha: </strong>
								<?php echo ucfirst(strftime("%b %d, %G",strtotime($fecha))); ?>
							</div>
							<?php if($listaEncuestas){ ?>
							<div class="col-lg-2">
								<form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaReservaFechaXLS"); ?>" target="_blank">
									<input type="hidden" class="form-control" id="bandera" name="bandera" value=1 />
									<input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha ?>" />
									<button type="submit" class="btn btn-primary btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
										Descargar Registros - XLS <span class="fa fa-file-excel-o" aria-hidden="true" />
									</button>
								</form>
							</div>
							<?php } ?>
						</div>
					</div>
				<?php
					}else{
					//si la consulta es por rango de fechas
				?>
					<div class="alert alert-success">
						<div class="row">
							<div class="col-lg-3">
								<strong>Rango de Fechas: </strong>
								<?php 
									echo ucfirst(strftime("%b %d, %G",strtotime($from))); 
									echo ' - ';
									echo ucfirst(strftime("%b %d, %G",strtotime($to))); 
								?>
							</div>
							<?php if($listaEncuestas){ ?>				
							<div class="col-lg-2">
								<form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaReservaFechaXLS"); ?>" target="_blank">
									<input type="hidden" class="form-control" id="bandera" name="bandera" value=2 />
									<input type="hidden" class="form-control" id="from" name="from" value="<?php echo $from; ?>" />
									<input type="hidden" class="form-control" id="to" name="to" value="<?php echo $to; ?>" />
									<button type="submit" class="btn btn-primary btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
										Descargar Registros - XLS <span class="fa fa-file-excel-o" aria-hidden="true" />
									</button>
								</form>
							</div>
							<?php } ?>
						</div>
					</div>
				<?php
					}
				?>
				
				<?php
				    if(!$listaEncuestas){ 
				?>
				        <div class="col-lg-12">
				            <small>
				                <p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en la base de datos.</p>
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
							foreach ($listaEncuestas as $lista):
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
				<?php } ?>
				</div>	
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->

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