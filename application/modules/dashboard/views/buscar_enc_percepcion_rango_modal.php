<script type="text/javascript" src="<?php echo base_url("assets/js/validate/dashboard/buscar_rango.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Buscar Encuestas x Rango de Fechas	</h4>
</div>
<div class="modal-body">
	<form name="form" id="form" role="form" method="post" action="<?php echo base_url('dashboard/buscar_encu_percepcion_rango'); ?>">
<script>
	$( function() {
		$( function() {
		var rangoFechas = $('#from, #to').datepicker({
	        changeMonth: true,
	        changeYear: true,
	        dateFormat: 'yy-mm-dd',
	        numberOfMonths: 1,
	        onSelect: function (selectedDate) {
	            var option = this.id == 'from' ? 'minDate' : 'maxDate',
	                instance = $(this).data('datepicker');
	            date = $.datepicker.parseDate(
	                instance.settings.dateFormat ||
	                $.datepicker._defaults.dateFormat,
	                selectedDate, instance.settings);
	            rangoFechas.not(this).datepicker('option', option, date);
	        }
	    });
    });
	});
</script>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="from">Desde:</label>
					<input type="text" class="form-control" id="from" name="from" value="" placeholder="Desde" required />
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="to">Hasta:</label>
					<input type="text" class="form-control" id="to" name="to" value="" placeholder="Hasta" required />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div id="div_load" style="display:none">		
				<div class="progress progress-striped active">
					<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
						<span class="sr-only">45% completado</span>
					</div>
				</div>
			</div>
			<div id="div_error" style="display:none">			
				<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj">&nbsp;</span></div>
			</div>	
		</div>
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<button type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
						Buscar <span class="glyphicon glyphicon-search" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>
	</form>
</div>