$( document ).ready( function () {

  jQuery.validator.addMethod("validarSatisfaccion", function(value, element, param) {
  var hdd_calificacion_1 = $('#hdd_calificacion_1').val();
  if(hdd_calificacion_1 != 99 && value == ""){
    return false;
  }else{
    return true;
  }
}, "Este campo es requerido.");
			
	$( "#form" ).validate( {
		rules: {
			hdd_autoriza: 			{ required: true },
			id_localidad: 			{ required: true },
			estrato: 				{ required: true },
			genero: 				{ required: true },
			id_grupo_etnico: 		{ required: true },
			id_rango_edades: 		{ required: true },
			hdd_calificacion_1: 		{ required: true  },
			hdd_calificacion_2: 		{ validarSatisfaccion: true  },
			hdd_calificacion_3: 		{ required: true },
			hdd_calificacion_4: 		{ required: true },
			hdd_calificacion_5: 		{ required: true },
			hdd_calificacion_6: 		{ required: true },
			hdd_calificacion_7: 		{ required: true },
			hdd_calificacion_8: 		{ required: true },
			hdd_calificacion_9: 		{ required: true },
			hdd_calificacion_10: 		{ required: true },
			hdd_calificacion_11: 		{ required: true },
			hdd_calificacion_12: 		{ required: true },
			hdd_calificacion_13: 		{ required: true }

		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );

		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
						
	$("#btnSubmit").click(function(){		
	
		if ($("#form").valid() == true){
		
				//Activa icono guardando
				$('#btnSubmit').attr('disabled','-1');
				$("#div_load").css("display", "inline");
				$("#div_error").css("display", "none");
			
				$.ajax({
					type: "POST",	
					url: base_url + "formulario/save_encuesta_percepcion",
					data: $("#form").serialize(),
					dataType: "json",
					contentType: "application/x-www-form-urlencoded;charset=UTF-8",
					cache: false,
					
					success: function(data){
                                            
						if( data.result == "error" )
						{
							alert(data.mensaje);
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');							
							
							$("#span_msj").html(data.mensaje);
							$("#div_error").css("display", "inline");
							return false;
						} 

						if( data.result )//true
						{	                                                        
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');

							var url = base_url + "formulario/percepcion";
							$(location).attr("href", url);
						}
						else
						{
							alert('Error. Reload the web page.');
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$('#btnSubmit').removeAttr('disabled');
						}	
					},
					error: function(result) {
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnSubmit').removeAttr('disabled');
					}
					
				});	
		
		}//if			
		else
		{
			alert('Faltan campos por diligenciar.');
			
		}					
	});

});