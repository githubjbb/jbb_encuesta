<script type="text/javascript" src="<?php echo base_url("assets/js/validate/formulario/ventanilla_virtual.js"); ?>"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-8">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-12">
                            <i class="fa fa-th"></i> <strong>Ventanilla Virtual</strong>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <p class="text-danger text-left">Los campos con (*) son obligatorios.</p>
                    <form  name="form" id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url("formulario/enviar_info_ventanillaVirtual"); ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <i class="fa fa-user"></i> <strong>Datos del Solicitante</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <p class="text-left"><strong>¿Conforme a la Política de Tratamiento de Datos Personales del JBB, autoriza expresamente el almacenamiento, uso y tratamiento de sus datos personales aportados, o previamente suministrados y contenidos en bases de datos del JBB? *</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input id="autoriza1" name="autoriza" class="autoriza" type="radio" value=1> Sí &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input id="autoriza2" name="autoriza" class="autoriza" type="radio" value=2> No
                                        <div class="row">
                                            <div class="col-sm-12">
                                                Para conocer nuestra Política de Tratamiento de Datos
                                                <a href="https://www.jbb.gov.co/documentos/secretaria_general/2019/politica_datos_personales.pdf" target="_blank"> consúltela aquí.</a></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4" id="tipoPersona">
                                                <p class="text-left"><strong>Tipo de Persona</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="tipo_persona" id="tipo_persona" class="form-control">
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
                                                        <select name="tipo_ident" id="tipo_ident" class="form-control">
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
                                                        <select name="tipo_entidad" id="tipo_entidad" class="form-control">
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
                                                        <select name="tipo_sociedad" id="tipo_sociedad" class="form-control">
                                                        <option value="">Seleccione...</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="numeroDoc">
                                                <p class="text-left"><strong>Número de Documento</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="documento" name="documento">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="tipoGenero">
                                                <p class="text-left"><strong>Genero</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="tipo_genero" id="tipo_genero" class="form-control">
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
                                                        <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="Nombres">
                                                <p class="text-left"><strong>Nombres</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="nombres" name="nombres">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="Apellidos">
                                                <p class="text-left"><strong>Apellidos</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="apellidos" name="apellidos">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="NombreEst">
                                                <p class="text-left"><strong>Razón Social</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="nombre_est" name="nombre_est">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="Telefono">
                                                <p class="text-left"><strong>Teléfono</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="telefono" name="telefono">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="Email">
                                                <p class="text-left"><strong>Correo Electrónico</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="email" class="form-control" id="email" name="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="Direccion">
                                                <p class="text-left"><strong>Dirección</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="direccion" name="direccion">
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
                                                <i class="fa fa-file"></i> <strong>Su Solicitud</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <p class="text-left"><strong>Tipo de Atención *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select name="tipo_atencion" id="tipo_atencion" class="form-control">
                                                        <option value="">Seleccione...</option>
                                                        <?php for ($i = 0; $i < count($listaTipoAtencion); $i++) { ?>
                                                            <option value="<?php echo $listaTipoAtencion[$i]["id_tipo_atencion"]; ?>"><?php echo $listaTipoAtencion[$i]["tipo_atencion"]; ?></option> 
                                                        <?php } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <p class="text-left"><strong>Asunto *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="asunto" id="asunto" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <p class="text-left"><strong>Archivo Adjunto *</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="file" name="userfile" id="userfile" />
                                                    </div>
                                                </div>
                                                <div class="alert alert-warning">
                                                    <strong>TENER EN CUENTA :</strong><br>
                                                    Formatos Permitidos : pdf<br>
                                                    Tamaño Máximo : 4096 KB<br>
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
                                                <i class="fa fa-files-o"></i> <strong>Anexos</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <p class="text-left"><strong>Archivo Adjunto</strong></p>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="file" name="anexos" id="anexos" />
                                                    </div>
                                                </div>
                                                <div class="alert alert-warning">
                                                    <strong>TENER EN CUENTA :</strong><br>
                                                    Formatos Permitidos : txt - doc - docx - xls - xlsx - png - jpg - jpeg - rar - zip<br>
                                                    Tamaño Máximo : 4096 KB<br>
                                                    Ancho Máximo : 2024 píxeles<br>
                                                    Altura Máxima : 2024 píxeles<br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>Captcha *</strong>
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