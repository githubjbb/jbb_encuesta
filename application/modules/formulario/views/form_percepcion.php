<script type="text/javascript" src="<?php echo base_url("assets/js/validate/formulario/encuesta_percepcion_v2.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/formulario/validaciones_percepcion_v2.js"); ?>"></script>

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
                        <div class="col-lg-12">  
                            <i class="fa fa-th"></i> <strong>Encuesta de percepción sobre la gestión del Jardín Botánico de Bogotá José Celestino Mutis </strong>
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
                        Gracias por completar esta encuesta. No le tomará más de cinco minutos.
                    </p>
                    <p class="text-danger text-left">Los campos con (*) son obligatorios.</p>

<form  name="form" id="form" class="form-horizontal" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <p class="text-left"><strong>¿Conforme a la Política de Tratamiento de Datos Personales del JBB, autoriza el tratamiento de datos personales?: * </strong><br>
                                    Para conocer nuestra Política de Tratamiento de Datos
                                    <a href="https://www.jbb.gov.co/documentos/secretaria_general/2019/politica_datos_personales.pdf" target="_blank"> consúltela aquí.</a></p>
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <input type="radio" name="autoriza" id="autoriza1" value=1 onclick="valid_field_autoriza()"> Si
                                            
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="radio" name="autoriza" id="autoriza2" value=2 onclick="valid_field_autoriza()"> No
                                        </div>
                                        <div class="col-sm-4">
                                             <input type="hidden" id="hdd_autoriza" name="hdd_autoriza" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <p class="text-left"><strong>Localidad donde vive: *</strong></p>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <select name="id_localidad" id="id_localidad" class="form-control" required >
                                                        <option value="">Select...</option>
                                                        <?php for ($i = 0; $i < count($listaLocalidades); $i++) { ?>
                                                            <option value="<?php echo $listaLocalidades[$i]["id_localidad"]; ?>"><?php echo $listaLocalidades[$i]["localidad"]; ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <p class="text-left"><strong>Estrato: *</strong></p>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <select name="estrato" id="estrato" class="form-control" required >
                                                        <option value="">Select...</option>
                                                        <?php for ($i = 1; $i <= 6; $i++) { ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <p class="text-left"><strong>Género: *</strong></p>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <select name="genero" id="genero" class="form-control" required >
                                                        <option value=''>Seleccione...</option>
                                                        <option value=1 >Hombre</option>
                                                        <option value=2 >Mujer</option>
                                                        <option value=3 >LGTBTI</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <p class="text-left"><strong>¿Pertenece a algún grupo étnico?: *</strong></p>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <select name="id_grupo_etnico" id="id_grupo_etnico" class="form-control" required >
                                                        <option value="">Select...</option>
                                                        <?php for ($i = 0; $i < count($listaGrupoEtnico); $i++) { ?>
                                                            <option value="<?php echo $listaGrupoEtnico[$i]["id_grupo_etnico"]; ?>"><?php echo $listaGrupoEtnico[$i]["grupo_etnico"]; ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <p class="text-left"><strong>Rango de edad: *</strong></p>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                   <select name="id_rango_edades" id="id_rango_edades" class="form-control" required >
                                                        <option value="">Select...</option>
                                                        <?php for ($i = 0; $i < count($listaRangoEdades); $i++) { ?>
                                                            <option value="<?php echo $listaRangoEdades[$i]["id_rango_edades"]; ?>"><?php echo $listaRangoEdades[$i]["rango_edades"]; ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-lg-12">  
                                            <i class="fa fa-tag"></i> <strong>¿Qué tanto conoce el Jardín Botánico? *</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                        </div>
                                        <div class="col-sm-1"><strong>1</strong></div>
                                        <div class="col-sm-1"><strong>2</strong></div>
                                        <div class="col-sm-1"><strong>3</strong></div>
                                        <div class="col-sm-1"><strong>4</strong></div>
                                        <div class="col-sm-1"><strong>5</strong></div>
                                        <div class="col-sm-2"></div>
                                    </div>
                         
                                    <div class="form-group">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-2">
                                            <strong> Muy Poco</strong>
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_1" id="calificacion_1_1" value=1 onclick="valid_calificacion_1()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_1" id="calificacion_1_2" value=2 onclick="valid_calificacion_1()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_1" id="calificacion_1_3" value=3 onclick="valid_calificacion_1()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_1" id="calificacion_1_4" value=4 onclick="valid_calificacion_1()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_1" id="calificacion_1_5" value=5 onclick="valid_calificacion_1()">
                                        </div>
                                        <div class="col-sm-2">
                                            <strong> Mucho</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_1" name="hdd_calificacion_1" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="div_grado_satisfaccion">
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-lg-12">  
                                            <i class="fa fa-tag"></i> <strong>¿Cuál es su grado de satisfacción con la gestión del Jardín Botánico? *</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                        </div>
                                        <div class="col-sm-1"><strong>1</strong></div>
                                        <div class="col-sm-1"><strong>2</strong></div>
                                        <div class="col-sm-1"><strong>3</strong></div>
                                        <div class="col-sm-1"><strong>4</strong></div>
                                        <div class="col-sm-1"><strong>5</strong></div>
                                        <div class="col-sm-2"></div>
                                    </div>
                         
                                    <div class="form-group">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-2">
                                            <strong> Muy bajo</strong>
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_2" id="calificacion_2_1" value=1 onclick="valid_calificacion_2()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_2" id="calificacion_2_2" value=2 onclick="valid_calificacion_2()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_2" id="calificacion_2_3" value=3 onclick="valid_calificacion_2()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_2" id="calificacion_2_4" value=4 onclick="valid_calificacion_2()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_2" id="calificacion_2_5" value=5 onclick="valid_calificacion_2()">
                                        </div>
                                        <div class="col-sm-2">
                                            <strong> Muy alto</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_2" name="hdd_calificacion_2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-lg-12">  
                                            <i class="fa fa-tag"></i> <strong>¿Qué tanto confía en el Jardín Botánico? *</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                        </div>
                                        <div class="col-sm-1"><strong>1</strong></div>
                                        <div class="col-sm-1"><strong>2</strong></div>
                                        <div class="col-sm-1"><strong>3</strong></div>
                                        <div class="col-sm-1"><strong>4</strong></div>
                                        <div class="col-sm-1"><strong>5</strong></div>
                                        <div class="col-sm-2"></div>
                                    </div>
                         
                                    <div class="form-group">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-2">
                                            <strong> Muy Poco</strong>
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_3" id="calificacion_3_1" value=1 onclick="valid_calificacion_3()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_3" id="calificacion_3_2" value=2 onclick="valid_calificacion_3()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_3" id="calificacion_3_3" value=3 onclick="valid_calificacion_3()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_3" id="calificacion_3_4" value=4 onclick="valid_calificacion_3()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_3" id="calificacion_3_5" value=5 onclick="valid_calificacion_3()">
                                        </div>
                                        <div class="col-sm-2">
                                            <strong> Mucho</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_3" name="hdd_calificacion_3" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-lg-12">  
                                            <i class="fa fa-tag"></i> <strong>¿Qué imagen tiene del JBB? *</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                        </div>
                                        <div class="col-sm-1"><strong>1</strong></div>
                                        <div class="col-sm-1"><strong>2</strong></div>
                                        <div class="col-sm-1"><strong>3</strong></div>
                                        <div class="col-sm-1"><strong>4</strong></div>
                                        <div class="col-sm-1"><strong>5</strong></div>
                                        <div class="col-sm-2"></div>
                                    </div>
                         
                                    <div class="form-group">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-2">
                                            <strong> Muy desfavorable</strong>
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_4" id="calificacion_4_1" value=1 onclick="valid_calificacion_4()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_4" id="calificacion_4_2" value=2 onclick="valid_calificacion_4()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_4" id="calificacion_4_3" value=3 onclick="valid_calificacion_4()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_4" id="calificacion_4_4" value=4 onclick="valid_calificacion_4()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_4" id="calificacion_4_5" value=5 onclick="valid_calificacion_4()">
                                        </div>
                                        <div class="col-sm-2">
                                            <strong>Muy favorable</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_4" name="hdd_calificacion_4" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-lg-12">  
                                            <i class="fa fa-tag"></i> <strong>¿A cuáles temas, el JBB debería prestar atención? * </strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <p class="text-center"><strong> Ítem</strong></p>
                                        </div>
                                        <div class="col-sm-1"><strong>Muy poca</strong></div>
                                        <div class="col-sm-1"><strong>Poca</strong></div>
                                        <div class="col-sm-1"><strong>Moderada</strong></div>
                                        <div class="col-sm-1"><strong>Mucha</strong></div>
                                    </div>
                         
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            Agricultura urbana y periurbana
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_5" id="calificacion_5_1" value=1 onclick="valid_calificacion_5()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_5" id="calificacion_5_2" value=2 onclick="valid_calificacion_5()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_5" id="calificacion_5_3" value=3 onclick="valid_calificacion_5()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_5" id="calificacion_5_4" value=4 onclick="valid_calificacion_5()">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_5" name="hdd_calificacion_5" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            Arborización urbana
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_6" id="calificacion_6_1" value=1 onclick="valid_calificacion_6()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_6" id="calificacion_6_2" value=2 onclick="valid_calificacion_6()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_6" id="calificacion_6_3" value=3 onclick="valid_calificacion_6()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_6" id="calificacion_6_4" value=4 onclick="valid_calificacion_6()">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_6" name="hdd_calificacion_6" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            Educación, cultura y participación ambiental
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_7" id="calificacion_7_1" value=1 onclick="valid_calificacion_7()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_7" id="calificacion_7_2" value=2 onclick="valid_calificacion_7()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_7" id="calificacion_7_3" value=3 onclick="valid_calificacion_7()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_7" id="calificacion_7_4" value=4 onclick="valid_calificacion_7()">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_7" name="hdd_calificacion_7" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-4">
                                           Investigación científica
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_8" id="calificacion_8_1" value=1 onclick="valid_calificacion_8()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_8" id="calificacion_8_2" value=2 onclick="valid_calificacion_8()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_8" id="calificacion_8_3" value=3 onclick="valid_calificacion_8()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_8" id="calificacion_8_4" value=4 onclick="valid_calificacion_8()">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_8" name="hdd_calificacion_8" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-lg-12">  
                                            <i class="fa fa-tag"></i> <strong>¿Cuál es su grado de satisfacción con los siguientes temas? * </strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <p class="text-center"><strong> Ítem</strong></p>
                                        </div>
                                        <div class="col-sm-1"><strong>Muy bajo</strong></div>
                                        <div class="col-sm-1"><strong>Bajo</strong></div>
                                        <div class="col-sm-1"><strong>Moderado</strong></div>
                                        <div class="col-sm-1"><strong>Alto</strong></div>
                                        <div class="col-sm-1"><strong>Muy alto</strong></div>
                                    </div>
                         
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            Agricultura urbana y periurbana
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_9" id="calificacion_9_1" value=1 onclick="valid_calificacion_9()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_9" id="calificacion_9_2" value=2 onclick="valid_calificacion_9()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_9" id="calificacion_9_3" value=3 onclick="valid_calificacion_9()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_9" id="calificacion_9_4" value=4 onclick="valid_calificacion_9()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_9" id="calificacion_9_5" value=5 onclick="valid_calificacion_9()">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_9" name="hdd_calificacion_9" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            Arborización urbana
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_10" id="calificacion_10_1" value=1 onclick="valid_calificacion_10()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_10" id="calificacion_10_2" value=2 onclick="valid_calificacion_10()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_10" id="calificacion_10_3" value=3 onclick="valid_calificacion_10()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_10" id="calificacion_10_4" value=4 onclick="valid_calificacion_10()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_10" id="calificacion_10_5" value=5 onclick="valid_calificacion_10()">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_10" name="hdd_calificacion_10" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            Educación, cultura y participación ambiental
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_11" id="calificacion_11_1" value=1 onclick="valid_calificacion_11()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_11" id="calificacion_11_2" value=2 onclick="valid_calificacion_11()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_11" id="calificacion_11_3" value=3 onclick="valid_calificacion_11()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_11" id="calificacion_11_4" value=4 onclick="valid_calificacion_11()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_11" id="calificacion_11_5" value=5 onclick="valid_calificacion_11()">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_11" name="hdd_calificacion_11" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-4">
                                           Investigación científica
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_12" id="calificacion_12_1" value=1 onclick="valid_calificacion_12()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_12" id="calificacion_12_2" value=2 onclick="valid_calificacion_12()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_12" id="calificacion_12_3" value=3 onclick="valid_calificacion_12()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_12" id="calificacion_12_4" value=4 onclick="valid_calificacion_12()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_12" id="calificacion_12_5" value=5 onclick="valid_calificacion_12()">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_12" name="hdd_calificacion_12" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-lg-12">  
                                            <i class="fa fa-tag"></i> <strong>¿Cuál es su grado de satisfacción con la cantidad de árboles en Bogotá? *</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                        </div>
                                        <div class="col-sm-1"><strong>1</strong></div>
                                        <div class="col-sm-1"><strong>2</strong></div>
                                        <div class="col-sm-1"><strong>3</strong></div>
                                        <div class="col-sm-1"><strong>4</strong></div>
                                        <div class="col-sm-1"><strong>5</strong></div>
                                        <div class="col-sm-2"></div>
                                    </div>
                         
                                    <div class="form-group">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-2">
                                            <strong> Muy bajo</strong>
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_13" id="calificacion_13_1" value=1 onclick="valid_calificacion_13()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_13" id="calificacion_13_2" value=2 onclick="valid_calificacion_13()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_13" id="calificacion_13_3" value=3 onclick="valid_calificacion_13()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_13" id="calificacion_13_4" value=4 onclick="valid_calificacion_13()">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="radio" name="calificacion_13" id="calificacion_13_5" value=5 onclick="valid_calificacion_13()">
                                        </div>
                                        <div class="col-sm-2">
                                            <strong>    Muy alto</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <input type="hidden" id="hdd_calificacion_13" name="hdd_calificacion_13" />
                                        </div>
                                    </div>
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