<script type="text/javascript" src="<?php echo base_url("assets/js/validate/formulario/encuesta.js"); ?>"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready(function () {
    $("#poblacion_discapacidad").on("click", function() {
        var condiciones = $("#poblacion_discapacidad").is(":checked");
        if (condiciones) {
            $("#div_cual").css("display", "inline");
            $('#poblacion_cual').val("");
        } else {
            $("#div_cual").css("display", "none");
            $('#poblacion_cual').val("");
        }
    }); 

    $("#servicio_otro").on("click", function() {
        var condiciones = $("#servicio_otro").is(":checked");
        if (condiciones) {
            $("#div_cual_servicio").css("display", "inline");
            $('#servicio_cual').val("");
        } else {
            $("#div_cual_servicio").css("display", "none");
            $('#servicio_cual').val("");
        }
    }); 

     $("#genero1").on("click", function() {
        $("#div_otro").css("display", "none");
        $('#genero_otro').val("");
    }); 

     $("#genero2").on("click", function() {
        $("#div_otro").css("display", "none");
        $('#genero_otro').val("");
    }); 

     $("#genero3").on("click", function() {
        $("#div_otro").css("display", "none");
        $('#genero_otro').val("");
    }); 

     $("#genero4").on("click", function() {
        $("#div_otro").css("display", "inline");
        $('#genero_otro').val("");
    }); 
});

function valid_field_edad() 
{
    if(document.getElementById('rango_edad1').checked || document.getElementById('rango_edad2').checked || document.getElementById('rango_edad3').checked ){
        document.getElementById('hdd_rango_edad').value = 1;
    }else{
        document.getElementById('hdd_rango_edad').value = "";
    }
}

function valid_field() 
{
    if(document.getElementById('poblacion_ninguna').checked ){
        document.getElementById('poblacion_discapacidad').checked=0;
        document.getElementById('poblacion_desplazado').checked=0;
        document.getElementById('poblacion_victima').checked=0;
        document.getElementById('poblacion_rom').checked=0;
        document.getElementById('poblacion_indigena').checked=0;
        document.getElementById('poblacion_raizal').checked=0;
        document.getElementById('hdd_poblacion').value = 1;
    }else{
        document.getElementById('hdd_poblacion').value = "";
    }
}

function valid_field2() 
{
    if(document.getElementById('poblacion_discapacidad').checked || document.getElementById('poblacion_desplazado').checked || document.getElementById('poblacion_victima').checked || document.getElementById('poblacion_rom').checked || document.getElementById('poblacion_indigena').checked || document.getElementById('poblacion_raizal').checked){
        document.getElementById('poblacion_ninguna').checked=0;
        document.getElementById('hdd_poblacion').value = 1;
    }else{
        document.getElementById('hdd_poblacion').value = "";
    }
}

function valid_field_genero() 
{
    if(document.getElementById('genero1').checked || document.getElementById('genero2').checked || document.getElementById('genero3').checked || document.getElementById('genero4').checked ){
        document.getElementById('hdd_genero').value = 1;
    }else{
        document.getElementById('hdd_genero').value = "";
    }
}

function valid_field_nacionalidad() 
{
    if(document.getElementById('nacionalidad1').checked || document.getElementById('nacionalidad2').checked ){
        document.getElementById('hdd_nacionalidad').value = 1;
    }else{
        document.getElementById('hdd_nacionalidad').value = "";
    }
}

function valid_field_servicio() 
{
    if(document.getElementById('servicio_pagina_web').checked || document.getElementById('servicio_volante').checked || document.getElementById('servicio_television').checked || document.getElementById('servicio_redes').checked || document.getElementById('servicio_amigo').checked || document.getElementById('servicio_correo').checked || document.getElementById('servicio_prensa').checked || document.getElementById('servicio_radio').checked || document.getElementById('servicio_otro').checked ){
        document.getElementById('hdd_servicio').value = 1;
    }else{
        document.getElementById('hdd_servicio').value = "";
    }
}

</script>

<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">

		<div class="col-lg-2">

		</div>

		<div class="col-lg-8">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-7">  
                            <i class="fa fa-edit"></i> <strong>ENCUESTA DE PERCEPCIÓN Y SATISFACCIÓN </strong><br>
                            ATENCIÓN A LA CIUDADANÍA<br>
                            <!--<small><strong>Código:</strong> DOC.PR.09.F.02 <strong>Versión 6</strong></small>-->
                            <small><strong>Código:</strong> SAC.PR.01.F.02 <strong>Versión 2</strong></small>
                        </div>

                    </div>
                </div>
                <div class="panel-body">
                <?php
                    $retornoExito = $this->session->flashdata('retornoExito');
                    if ($retornoExito) {
                ?>
                        <div class="col-lg-12">
                            <div class="row" align="center">
                                <div style="width:70%;" align="center">
                                    <div class="alert alert-success"> <span class="glyphicon glyphicon-ok">&nbsp;</span>
                                        Se registraron sus respuestas.
                                        <br><br>
                                        Gracias por brindarnos su opinión sobre la atención recibida.
                                    </div>
                                </div>
                            </div>  
                        </div>
                <?php
                    }else{
                ?>

                    <p>
                        Apreciado(a) ciudadano(a) su opinión es muy importante para el mejoramiento de nuestro servicio. Por favor diligencie el siguiente cuestionario sobre la atención recibida.
                    </p>
                    <p class="text-danger text-left">Los campos con (*) son obligatorios.</p>

                    <p class="text-left"><strong>Rango de edad del encuestado: *</strong></p>

                    <form  name="form" id="form" class="form-horizontal" method="post">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <input type="radio" name="rango_edad" id="rango_edad1" value=1 onclick="valid_field_edad()"> Menor de 26 años 
                                <input type="hidden" id="hdd_rango_edad" name="hdd_rango_edad" />
                            </div>
                            <div class="col-sm-3">
                                <input type="radio" name="rango_edad" id="rango_edad2" value=2 onclick="valid_field_edad()"> 27 a 59 años
                            </div>
                            <div class="col-sm-3">
                                <input type="radio" name="rango_edad" id="rango_edad3" value=3 onclick="valid_field_edad()"> Mayor de 60 años
                            </div>
                        </div>

                        <p class="text-left"><strong>Población: *</strong></p>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <input type="checkbox" name="poblacion_discapacidad" id="poblacion_discapacidad" value=1 onclick="valid_field2()"> Condición de discapacidad
                            </div>

                            <div class="col-sm-8" id="div_cual" style="display: none">
                                <input type="text" id="poblacion_cual" name="poblacion_cual" class="form-control" placeholder="¿Cuál?" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <input type="checkbox" name="poblacion_desplazado" id="poblacion_desplazado" value=1 onclick="valid_field2()"> Desplazado<br>
                                <input type="checkbox" name="poblacion_victima" id="poblacion_victima" value=1 onclick="valid_field2()"> Víctima de conflicto armado
                                <input type="hidden" id="hdd_poblacion" name="hdd_poblacion" />
                            </div>
                            <div class="col-sm-3">
                                <input type="checkbox" name="poblacion_rom" id="poblacion_rom" value=1 onclick="valid_field2()"> Rom<br>
                                <input type="checkbox" name="poblacion_indigena" id="poblacion_indigena" value=1 onclick="valid_field2()"> Indígena
                            </div>
                            <div class="col-sm-3">
                                <input type="checkbox" name="poblacion_raizal" id="poblacion_raizal" value=1 onclick="valid_field2()"> Raizal<br>
                                <input type="checkbox" name="poblacion_ninguna" id="poblacion_ninguna" value=1 onclick="valid_field()"> Ninguna
                            </div>
                        </div>

                        <p class="text-left"><strong>Género: *</strong></p>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <input type="radio" name="genero" id="genero1" value=1 onclick="valid_field_genero()"> Hombre<br>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" name="genero" id="genero2" value=2 onclick="valid_field_genero()"> Mujer
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" name="genero" id="genero3" value=3 onclick="valid_field_genero()"> No responde
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <input type="radio" name="genero" id="genero4" value=4 onclick="valid_field_genero()"> Otro
                                <input type="hidden" id="hdd_genero" name="hdd_genero" />
                            </div>
                            <div class="col-sm-8" id="div_otro" style="display: none">
                                <input type="text" id="genero_otro" name="genero_otro" class="form-control" placeholder="¿Cuál?" >
                            </div>
                        </div>

                        <p class="text-left"><strong>Nacionalidad: *</strong></p>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <input type="radio" name="nacionalidad" id="nacionalidad1" value=1 onclick="valid_field_nacionalidad()"> Colombiano
                                <input type="hidden" id="hdd_nacionalidad" name="hdd_nacionalidad" />
                            </div>
                            <div class="col-sm-3">
                                <input type="radio" name="nacionalidad" id="nacionalidad2" value=2 onclick="valid_field_nacionalidad()"> Extranjero
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <p class="text-left"><strong>Localidad:</strong></p>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" id="localidad" name="localidad" class="form-control" placeholder="Localidad" >
                                    </div>
                                </div>
                            </div>

                            <!--<div class="col-sm-6">
                                <p class="text-left"><strong>Barrio:</strong></p>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" id="barrio" name="barrio" class="form-control" placeholder="Barrio" >
                                    </div>
                                </div>
                            </div>-->
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <p class="text-left"><strong>¿Qué servicio utilizó durante su visita o llamada realizada? *</strong></p>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" id="servicio" name="servicio" class="form-control" required >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="text-left">
                            <strong>¿Cómo se enteró de los servicios que ofrece el Jardín Botánico de Bogotá? *</strong>
                        </p>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <input type="checkbox" id="servicio_pagina_web" name="servicio_pagina_web" value=1 onclick="valid_field_servicio()"> Página Web<br>
                                <input type="checkbox" id="servicio_volante" name="servicio_volante" value=1 onclick="valid_field_servicio()"> Volante/Plegable
                            </div>
                            <div class="col-sm-3">
                                <input type="checkbox" id="servicio_television" name="servicio_television" value=1 onclick="valid_field_servicio()"> Televisión<br>
                                <input type="checkbox" id="servicio_redes" name="servicio_redes" value=1 onclick="valid_field_servicio()"> Redes Sociales
                            </div>
                            <div class="col-sm-3">
                                <input type="checkbox" id="servicio_amigo" name="servicio_amigo" value=1 onclick="valid_field_servicio()"> Amigo/Familiar<br>
                                <input type="checkbox" id="servicio_correo" name="servicio_correo" value=1 onclick="valid_field_servicio()"> Correo electrónico
                            </div>
                            <div class="col-sm-3">
                                <input type="checkbox" id="servicio_prensa" name="servicio_prensa" value=1 onclick="valid_field_servicio()"> Prensa<br>
                                <input type="checkbox" id="servicio_radio" name="servicio_radio" value=1 onclick="valid_field_servicio()"> Radio
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <input type="checkbox" name="servicio_otro" id="servicio_otro" value=1 onclick="valid_field_servicio()"> Otro
                                <input type="hidden" id="hdd_servicio" name="hdd_servicio" />
                            </div>

                            <div class="col-sm-8" id="div_cual_servicio" style="display: none">
                                <input type="text" id="servicio_cual" name="servicio_cual" class="form-control" placeholder="¿Cuál?" >
                            </div>
                        </div>

                        <br>
                        <p class="text-left">
                            <strong>Califique con una equis (x) su grado de satisfacción en una escala de 1 a 5, siendo uno (1) Insatisfecho y cinco (5) totalmente satisfecho o N/A en caso de ser necesario:</strong>
                        </p>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <p class="text-center"><strong> Ítem</strong></p>
                            </div>
                            <div class="col-sm-1"><strong>1</strong></div>
                            <div class="col-sm-1"><strong>2</strong></div>
                            <div class="col-sm-1"><strong>3</strong></div>
                            <div class="col-sm-1"><strong>4</strong></div>
                            <div class="col-sm-1"><strong>5</strong></div>
                            <div class="col-sm-2"><strong>No Sabe /<br> No responde</strong></div>
                        </div>
             
                        <div class="form-group">
                            <!--<div class="col-sm-5">Profesionalismo y claridad de la información</div>-->
                            <div class="col-sm-5">Conocimiento del tema</div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_1" id="calificacion_1_1" value=1>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_1" id="calificacion_1_2" value=2>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_1" id="calificacion_1_3" value=3>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_1" id="calificacion_1_4" value=4>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_1" id="calificacion_1_5" value=5>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" name="calificacion_1" id="calificacion_1_6" value=6>
                            </div>
                        </div>

                        <div class="form-group">
                            <!--<div class="col-sm-5">Amabilidad y actitud de servicio</div>-->
                            <div class="col-sm-5">Amabilidad y disposición de servicio</div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_2" id="calificacion_2_1" value=1>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_2" id="calificacion_2_2" value=2>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_2" id="calificacion_2_3" value=3>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_2" id="calificacion_2_4" value=4>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_2" id="calificacion_2_5" value=5>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" name="calificacion_2" id="calificacion_2_6" value=6>
                            </div>
                        </div>

                        <div class="form-group">
                            <!--<div class="col-sm-5">Orientación y guianza</div>-->
                            <div class="col-sm-5">Tiempo de espera</div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_3" id="calificacion_3_1" value=1>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_3" id="calificacion_3_2" value=2>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_3" id="calificacion_3_3" value=3>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_3" id="calificacion_3_4" value=4>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_3" id="calificacion_3_5" value=5>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" name="calificacion_3" id="calificacion_3_6" value=6>
                            </div>
                        </div>

                        <!--<div class="form-group">
                            <div class="col-sm-5">
                                 Estado de las colecciones de la entidad
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_4" id="calificacion_4_1" value=1>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_4" id="calificacion_4_2" value=2>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_4" id="calificacion_4_3" value=3>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_4" id="calificacion_4_4" value=4>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_4" id="calificacion_4_5" value=5>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" name="calificacion_4" id="calificacion_4_6" value=6>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <div class="col-sm-5">
                                Estado de la infraestructura e instalaciones
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_5" id="calificacion_5_1" value=1>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_5" id="calificacion_5_2" value=2>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_5" id="calificacion_5_3" value=3>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_5" id="calificacion_5_4" value=4>
                            </div>
                            <div class="col-sm-1">
                                <input type="radio" name="calificacion_5" id="calificacion_5_5" value=5>
                            </div>
                            <div class="col-sm-2">
                                <input type="radio" name="calificacion_5" id="calificacion_5_6" value=6>
                            </div>
                        </div>

                        <p class="text-left">
                            <strong>
                                ¿Cuál es su percepción frente al servicio? Por favor escríbalo aquí:
                            </strong>
                        </p>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea id="percepcion" name="percepcion" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <p class="text-left"><strong>Nombre del Servidor Público que le atendió:</strong></p>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" id="nombre_servidor" name="nombre_servidor" class="form-control" placeholder="Nombre del Servidor" >
                                    </div>
                                </div>
                            </div>

<script>
    $( function() {
        $( "#fecha" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
</script>

                            <div class="col-sm-6">
                                <p class="text-left"><strong>Fecha:</strong></p>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="fecha" name="fecha" placeholder="Fecha" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="form-group">
                            <div class="row" align="center">
                                <div style="width:100%;" align="center">                            
                                    <button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-success'>
                                        Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php
                    }
                ?>

                    <br>
                    <div class="col-lg-12">
                        <div class="row" align="center">
                            <div style="width:50%;" align="center">
                                Línea telefónica Jardín Botánico de Bogotá para presentar <br>
                                Peticiones, Quejas, Reclamos, Sugerencias <br>
                                4377060 Ext. 1012 <br>
                            </div>
                        </div>  
                    </div>

                </div>
            </div>
		</div>			
	</div>
</div>