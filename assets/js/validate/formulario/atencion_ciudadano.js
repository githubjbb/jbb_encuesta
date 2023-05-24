$( document ).ready( function () {

    $("#asunto").maxlength(500);
    $("#palabra_clave").maxlength(20);
    $("#nombres").maxlength(50).convertirMayuscula();
    $("#apellidos").maxlength(50).convertirMayuscula();
    $("#nombre_est").maxlength(50).convertirMayuscula();
    $("#direccion").maxlength(100).convertirMayuscula();
    $("#email").maxlength(50).convertirMinuscula();
	$("#documento").bloquearTexto().maxlength(10);
	$("#edad").bloquearTexto().maxlength(3);
    $("#telefono").bloquearTexto().maxlength(10);
    $("#codigo_postal").bloquearTexto().maxlength(10);

	$('#tipo_entidad').change(function () {
        $('#tipo_entidad option:selected').each(function () {
            var entidad = $('#tipo_entidad').val();
            if (entidad > 0 || entidad != '') {
                $.ajax ({
                    cache: false,
                    contentType: 'application/x-www-form-urlencoded;charset=UTF-8',
                    data: {'identificador': entidad},
                    dataType: 'html',
                    type: 'POST',
                    url: base_url + 'formulario/listaTipoSociedad',
                    success: function (data) {
                        $('#tipo_sociedad').html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error al buscar. Intente nuevamente o actualice la p\u00e1gina.');
                        location.reload();
                    }
                });
            } else {
                var data = '<option value="">Seleccione</option>';
                $('#tipo_sociedad').html(data);
            }
        });
    });

    $('#localidad').change(function () {
        $('#localidad option:selected').each(function () {
            var localidad = $('#localidad').val();
            if (localidad > 0 || localidad != '') {
            	var data2 = '<option value="">Seleccione</option>';
                $('#barrio').html(data2);
                $.ajax ({
                    cache: false,
                    contentType: 'application/x-www-form-urlencoded;charset=UTF-8',
                    data: {'identificador': localidad},
                    dataType: 'html',
                    type: 'POST',
                    url: base_url + 'formulario/listaUPZ',
                    success: function (data) {
                        $('#upz').html(data);
                        $('#barrio').html(data2);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error al buscar. Intente nuevamente o actualice la p\u00e1gina.');
                        location.reload();
                    }
                });
            } else {
                var data = '<option value="">Seleccione</option>';
                $('#upz').html(data);
                var data2 = '<option value="">Seleccione</option>';
                $('#barrio').html(data2);
            }
        });
    });

    $('#upz').change(function () {
        $('#upz option:selected').each(function () {
            var upz = $('#upz').val();
            if (upz > 0 || upz != '') {
                $.ajax ({
                    cache: false,
                    contentType: 'application/x-www-form-urlencoded;charset=UTF-8',
                    data: {'identificador': upz},
                    dataType: 'html',
                    type: 'POST',
                    url: base_url + 'formulario/listaBarrios',
                    success: function (data) {
                        $('#barrio').html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error al buscar. Intente nuevamente o actualice la p\u00e1gina.');
                        location.reload();
                    }
                });
            } else {
                var data = '<option value="">Seleccione</option>';
                $('#barrio').html(data);
            }
        });
    });

    $( function() {
        $( "#fecha_nacimiento" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            maxDate: 'now'
        });
    });

    $("#tipoPersona").css("display", "none");
    $("#tipoIdent").css("display", "none");
    $("#tipoEntidad").css("display", "none");
    $("#tipoSociedad").css("display", "none");
    $("#numeroDoc").css("display", "none");
    $("#tipoGenero").css("display", "none");
    $("#fechaNac").css("display", "none");
    $("#Acompanamiento").css("display", "none");
    $("#Edad").css("display", "none");
    $("#Nombres").css("display", "none");
    $("#Apellidos").css("display", "none");
    $("#NombreEst").css("display", "none");
    $("#Telefono").css("display", "none");
    $("#Email").css("display", "none");
    $("#Condicion").css("display", "block");

    $("#autoriza1").on("click", function() {
        $("#tipoPersona").css("display", "block");
        $("#tipo_persona").on("change", function() {
            $("#tipo_ident").val('');
            $("#tipo_entidad").val('');
            $("#tipo_sociedad").val('');
            $("#documento").val('');
            $("#tipo_genero").val('');
            $("#fecha_nacimiento").val('');
            $("#tipo_acompanamiento").val('');
            $("#edad").val('');
            $("#nombres").val('');
            $("#apellidos").val('');
            $("#nombre_est").val('');
            $("#telefono").val('');
            $("#email").val('');
            $("#condicion").val('');
            if (this.value == "") {
                $("#tipoIdent").css("display", "none");
                $("#tipoEntidad").css("display", "none");
                $("#tipoSociedad").css("display", "none");
                $("#numeroDoc").css("display", "none");
                $("#tipoGenero").css("display", "none");
                $("#fechaNac").css("display", "none");
                $("#Acompanamiento").css("display", "none");
                $("#Edad").css("display", "none");
                $("#Nombres").css("display", "none");
                $("#Apellidos").css("display", "none");
                $("#NombreEst").css("display", "none");
                $("#Telefono").css("display", "none");
                $("#Email").css("display", "none");
                $("#Condicion").css("display", "block");
                $("input:radio[name=entidadDistrital]:checked")[0].checked = false;
            } else if(this.value == 1) {
                $("#tipoIdent").css("display", "block");
                $("#tipoEntidad").css("display", "none");
                $("#tipoSociedad").css("display", "none");
                $("#numeroDoc").css("display", "block");
                $("#tipoGenero").css("display", "block");
                $("#fechaNac").css("display", "block");
                $("#Acompanamiento").css("display", "none");
                $("#Edad").css("display", "none");
                $("#Nombres").css("display", "block");
                $("#Apellidos").css("display", "block");
                $("#NombreEst").css("display", "none");
                $("#Telefono").css("display", "block");
                $("#Email").css("display", "block");
                $("#Condicion").css("display", "block");
                $("input:radio[name=entidadDistrital]:checked")[0].checked = false;
            } else if(this.value == 2) {
                $("#tipoIdent").css("display", "none");
                $("#tipoEntidad").css("display", "block");
                $("#tipoSociedad").css("display", "block");
                $("#numeroDoc").css("display", "block");
                $("#tipoGenero").css("display", "none");
                $("#fechaNac").css("display", "none");
                $("#Acompanamiento").css("display", "none");
                $("#Edad").css("display", "none");
                $("#Nombres").css("display", "none");
                $("#Apellidos").css("display", "none");
                $("#NombreEst").css("display", "block");
                $("#Telefono").css("display", "block");
                $("#Email").css("display", "block");
                $("#Condicion").css("display", "none");
                $("input:radio[name=entidadDistrital]:checked")[0].checked = false;
            } else if(this.value == 3) {
                $("#tipoIdent").css("display", "none");
                $("#tipoEntidad").css("display", "none");
                $("#tipoSociedad").css("display", "none");
                $("#numeroDoc").css("display", "block");
                $("#tipoGenero").css("display", "none");
                $("#fechaNac").css("display", "none");
                $("#Acompanamiento").css("display", "none");
                $("#Edad").css("display", "none");
                $("#Nombres").css("display", "none");
                $("#Apellidos").css("display", "none");
                $("#NombreEst").css("display", "block");
                $("#Telefono").css("display", "block");
                $("#Email").css("display", "block");
                $("#Condicion").css("display", "none");
                $("input:radio[name=entidadDistrital]:checked")[0].checked = false;
            } else if(this.value == 4) {
                $("#tipoIdent").css("display", "none");
                $("#tipoEntidad").css("display", "none");
                $("#tipoSociedad").css("display", "none");
                $("#numeroDoc").css("display", "none");
                $("#tipoGenero").css("display", "none");
                $("#fechaNac").css("display", "none");
                $("#Acompanamiento").css("display", "block");
                $("#Edad").css("display", "block");
                $("#Nombres").css("display", "block");
                $("#Apellidos").css("display", "block");
                $("#NombreEst").css("display", "none");
                $("#Telefono").css("display", "block");
                $("#Email").css("display", "block");
                $("#Condicion").css("display", "none");
                $("input:radio[name=entidadDistrital]:checked")[0].checked = false;
            } else if(this.value == 5) {
                $("#tipoIdent").css("display", "none");
                $("#tipoEntidad").css("display", "none");
                $("#tipoSociedad").css("display", "none");
                $("#numeroDoc").css("display", "none");
                $("#tipoGenero").css("display", "none");
                $("#fechaNac").css("display", "none");
                $("#Acompanamiento").css("display", "none");
                $("#Edad").css("display", "none");
                $("#Nombres").css("display", "none");
                $("#Apellidos").css("display", "none");
                $("#NombreEst").css("display", "none");
                $("#Telefono").css("display", "block");
                $("#Email").css("display", "block");
                $("#Condicion").css("display", "block");
                $("input:radio[name=entidadDistrital]:checked")[0].checked = false;
            }
        });
    });

    $("#autoriza2").on("click", function() {
        $("#tipoPersona").css("display", "none");
        $("#tipoIdent").css("display", "none");
        $("#tipoEntidad").css("display", "none");
        $("#tipoSociedad").css("display", "none");
        $("#numeroDoc").css("display", "none");
        $("#tipoGenero").css("display", "none");
        $("#fechaNac").css("display", "none");
        $("#Acompanamiento").css("display", "none");
        $("#Edad").css("display", "none");
        $("#Nombres").css("display", "none");
        $("#Apellidos").css("display", "none");
        $("#NombreEst").css("display", "none");
        $("#Telefono").css("display", "none");
        $("#Email").css("display", "none");
        $("#Condicion").css("display", "block");
        $("#tipo_persona").val('');
    });

    $( "#form" ).validate( {
		rules: {
			autoriza: 			{ required: true },
			asunto: 			{ required: true },
			tipo_atencion: 		{ required: true },
			tema: 				{ required: true },
			localidad: 			{ required: true },
            upz:                { required: true },
			barrio: 			{ required: true },
			direccion: 			{ required: true },
			estrato: 			{ required: true },
			confirmar:   		{ required: true }
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
});