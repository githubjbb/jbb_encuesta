<script type="text/javascript" src="<?php echo base_url("assets/js/validate/formulario/atencion_ciudadano.js"); ?>"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-12">
                            <i class="fa fa-th"></i> <strong>Formulario de PQRSD del Jardín Botánico de Bogotá José Celestino Mutis </strong>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <p class="text-danger text-left">Los campos con (*) son obligatorios.</p>
                    <form  name="form" id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url("formulario/enviar_informacion"); ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-lg-12">  
                                                <i class="fa fa-user"></i> <strong>Datos del Solicitante</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <p class="text-left"><strong>¿Conforme a la Política de Tratamiento de Datos Personales del JBB, autoriza expresamente el almacenamiento, uso y tratamiento de sus datos personales aportados, o previamente suministrados y contenidos en bases de datos del JBB? *</strong><br>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                Para conocer nuestra Política de Tratamiento de Datos
                                                <a href="https://www.jbb.gov.co/documentos/secretaria_general/2019/politica_datos_personales.pdf" target="_blank"> consúltela aquí.</a></p>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input id="autoriza1" name="autoriza" class="autoriza" type="radio" value=1 > Sí &nbsp;&nbsp;&nbsp;
                                                        <input id="autoriza2" name="autoriza" class="autoriza" type="radio" value=2 > No
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="text-left"><strong>Tipo de Persona *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="tipo_persona" id="tipo_persona" class="form-control" title="Seleccione el tipo de persona según corresponda." required >
                                                            <option value="">Seleccione...</option>
                                                            <?php for ($i = 0; $i < count($listaTipoPersonas); $i++) { ?>
                                                                <option value="<?php echo $listaTipoPersonas[$i]["id_tipo_persona"]; ?>"><?php echo $listaTipoPersonas[$i]["tipo_persona"]; ?></option> 
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4" id="tipoIdent">
                                                <p class="text-left"><strong>Tipo de Identificación</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="tipo_ident" id="tipo_ident" class="form-control" title="Seleccione el tipo de identificación según corresponda." >
                                                        <option value="">Seleccione...</option>
                                                        <?php for ($i = 0; $i < count($listaTipoIdent); $i++) { ?>
                                                            <option value="<?php echo $listaTipoIdent[$i]["id_tipo_identificacion"]; ?>"><?php echo $listaTipoIdent[$i]["tipo_identificacion"]; ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="tipoEntidad">
                                                <p class="text-left"><strong>Tipo de Entidad</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="tipo_entidad" id="tipo_entidad" class="form-control" title="Seleccione el tipo de entidad según corresponda." >
                                                        <option value="">Seleccione...</option>
                                                        <?php for ($i = 0; $i < count($listaTipoEntidad); $i++) { ?>
                                                            <option value="<?php echo $listaTipoEntidad[$i]["id_tipo_entidad"]; ?>"><?php echo $listaTipoEntidad[$i]["tipo_entidad"]; ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="tipoSociedad">
                                                <p class="text-left"><strong>Tipo de Empresa/Sociedad</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="tipo_sociedad" id="tipo_sociedad" class="form-control" title="Seleccione el tipo de sociedad según corresponda." >
                                                        <option value="">Seleccione...</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="numeroDoc">
                                                <p class="text-left"><strong>Número de Documento</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="documento" name="documento" title="Registre su número de identificación sin puntos, sin comas, ni espacios." >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="tipoGenero">
                                                <p class="text-left"><strong>Genero</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="tipo_genero" id="tipo_genero" class="form-control" title="Seleccione el tipo de género según corresponda." >
                                                        <option value="">Seleccione...</option>
                                                        <?php for ($i = 0; $i < count($listaGenero); $i++) { ?>
                                                            <option value="<?php echo $listaGenero[$i]["id_genero"]; ?>"><?php echo $listaGenero[$i]["genero"]; ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="fechaNac">
                                                <p class="text-left"><strong>Fecha de Nacimiento</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" title="Seleccione el día, mes y año de nacimiento." >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="Edad">
                                                <p class="text-left"><strong>Edad</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="edad" name="edad" title="Registre su edad." >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="Nombres">
                                                <p class="text-left"><strong>Nombres</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="nombres" name="nombres" title="Registre sus nombres." >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="Apellidos">
                                                <p class="text-left"><strong>Apellidos</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="apellidos" name="apellidos" title="Registre sus apellidos." >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="NombreEst">
                                                <p class="text-left"><strong>Razón Social</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="nombre_est" name="nombre_est" title="Registre el nombre del comercio." >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="Telefono">
                                                <p class="text-left"><strong>Teléfono</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="telefono" name="telefono" title="Ingrese número de celular donde podamos contactarlo." >
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
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-lg-12">  
                                                <i class="fa fa-file"></i> <strong>Su Petición</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row" id="Condicion">
                                            <div class="col-sm-5">
                                                <p class="text-left"><strong>1. Condición</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="condicion" id="condicion" class="form-control" title="Si presenta alguna de las condiciones descritas selecciónela, de lo contrario, escoja la opción ninguna." >
                                                            <option value="">Seleccione...</option>
                                                            <?php for ($i = 0; $i < count($listaCondiciones); $i++) { ?>
                                                                <option value="<?php echo $listaCondiciones[$i]["id_condicion"]; ?>"><?php echo $listaCondiciones[$i]["condicion"]; ?></option> 
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <p class="text-left"><strong>Pertenece a una Entidad Distrital</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input id="entidadDistrital1" name="entidadDistrital" class="entidadDistrital" type="radio" value=1 title="Indique si hace parte de alguna entidad del Distrito."> Sí &nbsp;&nbsp;&nbsp;
                                                        <input id="entidadDistrital2" name="entidadDistrital" class="entidadDistrital" type="radio" value=2 title="Indique si hace parte de alguna entidad del Distrito."> No
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <p class="text-left"><strong>2. Asunto *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="asunto" id="asunto" rows="5" title="Describa detalladamente su solicitud teniendo en cuenta: el objeto de la petición, los hechos (en modo, tiempo y lugar), documentación que se requiera aportar y la pretensión o propósito de la misma." required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="text-left"><strong>3. Archivo Adjunto</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="file" name="userfile" id="userfile" />
                                                    </div>
                                                </div>
                                                <div class="alert alert-warning">
                                                    <strong>TENER EN CUENTA :</strong><br>
                                                    Formatos Permitidos : pdf - txt - doc - docx - xls - xlsx - png - jpg<br>
                                                    Tamaño Máximo : 3048 KB<br>
                                                    Ancho Máximo : 2024 píxeles<br>
                                                    Altura Máxima : 2024 píxeles<br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <i class="fa fa-info-circle"></i> <strong>Datos Utiles para una Gestión más Ágil</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        Diligenciar esta información será útil para direccionar tu petición a la entidad competente<br><br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="text-left"><strong>4. Tipo de Petición *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="tipo_atencion" id="tipo_atencion" class="form-control" title="Seleccione el tipo de petición que desea interponer ante la Administración Distrital." >
                                                        <option value="">Seleccione...</option>
                                                        <?php for ($i = 0; $i < count($listaTipoAtencion); $i++) { ?>
                                                            <option value="<?php echo $listaTipoAtencion[$i]["id_tipo_atencion"]; ?>"><?php echo $listaTipoAtencion[$i]["tipo_atencion"]; ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="text-left"><strong>5. Palabra Clave *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="palabra_clave" name="palabra_clave" title="Ingrese una palabra o frase clave que identifique el tema a tratar en su petición." >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="text-left"><strong>6. Tema *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="tema" id="tema" class="form-control" title="Seleccione el tema que tenga relación con su petición. Están relacionados con temáticas centrales de la Administración Distrital." >
                                                        <option value="">Seleccione...</option>
                                                        <?php for ($i = 0; $i < count($listaTemas); $i++) { ?>
                                                            <option value="<?php echo $listaTemas[$i]["id_tema"]; ?>"><?php echo $listaTemas[$i]["tema"]; ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="text-left"><strong>7. Correo Electrónico *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="email" class="form-control" id="email" name="email" title="Ingrese el correo electrónico al cual se le enviarán las notificaciones sobre la petición a realizar." >
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
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-lg-12">  
                                                <i class="fa fa-map-marker"></i> <strong>Lugar del Incidente</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="text-left"><strong>8. Localidad *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="localidad" id="localidad" class="form-control" title="Seleccione la localidad asociada a la dirección donde ocurrieron los hechos." >
                                                        <option value="">Seleccione...</option>
                                                        <?php for ($i = 0; $i < count($listaLocalidades); $i++) { ?>
                                                            <option value="<?php echo $listaLocalidades[$i]["id_localidad"]; ?>"><?php echo $listaLocalidades[$i]["id_localidad"] . ' - ' . $listaLocalidades[$i]["localidad"]; ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="text-left"><strong>9. UPZ *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="upz" id="upz" class="form-control" title="Seleccione la UPZ asociada a la dirección de residencia o de contacto." >
                                                        <option value="">Seleccione...</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="text-left"><strong>10. Barrio *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="barrio" id="barrio" class="form-control" title="Seleccione el barrio asociado a la localidad donde ocurrieron los hechos." >
                                                        <option value="">Seleccione...</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="text-left"><strong>11. Dirección *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="direccion" name="direccion" title="Ingrese la dirección donde ocurrieron los hechos o situaciones manifestadas en su petición. Si no cuenta con los datos exactos de la ubicación geográfica- registre una dirección aproximada al lugar de los hechos." >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <p class="text-left"><strong>12. Estrato *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="estrato" id="estrato" class="form-control" title="Seleccione el estrato socioeconómico al cual pertenece el  lugar de los hechos." >
                                                        <option value="">Seleccione...</option>
                                                        <?php for ($i = 0; $i < count($listaEstratos); $i++) { ?>
                                                            <option value="<?php echo $listaEstratos[$i]["id_estrato"]; ?>"><?php echo $listaEstratos[$i]["estrato"]; ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <p class="text-left"><strong>13. Código Postal *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" title="Ingrese el código postal." >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="checkbox" class="cbCondiciones" id="confirmar" name="confirmar" > 14. Certifico que el correo electrónico ingresado en mis datos personales se encuentra vigente, de igual manera autorizo a Bogotá Te Escucha - Sistema Distrital de Quejas y Soluciones para el envío de la respuesta a mi solicitud por este medio. *
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>15. Captcha *</strong>
                                                <div class="g-recaptcha" data-sitekey="6Ld11PYlAAAAAH9UfN_NSlyu77QH0XDfVllyEZHx">
                                                </div>
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
                                    <button type="submit" id="btnSubmit" name="btnSubmit" class='btn btn-primary'>
                                        Enviar <span class="glyphicon glyphicon-send" aria-hidden="true">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>			
	</div>
</div>