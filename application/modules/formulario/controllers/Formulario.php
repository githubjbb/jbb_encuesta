<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulario extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("formulario_model");
        $this->load->model("general_model");
		$this->load->helper('form');
    }
	
	/**
	 * Formulario encuesta de satisfaccion
	 */
	public function index()
	{
		$data['view'] = 'form_encuesta';
		$this->load->view('layout_calendar', $data);
	}

	/**
	 * Save formulario de satisfaccion
	 * @author BMOTTAG
     * @since 27/6/2021
	 */
	public function save_encuesta()
	{
		header('Content-Type: application/json');
		$data = array();
		$msj = "Se guardó la información de la encuesta!";
		if ($this->formulario_model->saveEncuesta()) 
		{
			$data["result"] = true;
			$this->session->set_flashdata('retornoExito', $msj);
		} else {
			$data["result"] = "error";
			$data["mensaje"] = "Error!!! Ask for help.";
			$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
		}
		echo json_encode($data);
    }

	/**
	 * Formulario de percepcion
	 * @author BMOTTAG
     * @since 25/11/2021
	 */
	public function percepcion()
	{
		$arrParam = array(
			"table" => "param_localidades",
			"order" => "id_localidad",
			"id" => "x"
		);
		$data['listaLocalidades'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_genero",
			"order" => "id_genero",
			"id" => "x"
		);
		$data['listaGenero'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_grupo_etnico",
			"order" => "id_grupo_etnico",
			"id" => "x"
		);
		$data['listaGrupoEtnico'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_rango_edades",
			"order" => "id_rango_edades",
			"id" => "x"
		);
		$data['listaRangoEdades'] = $this->general_model->get_basic_search($arrParam);
		$data['view'] = 'form_percepcion';
		$this->load->view('layout_calendar', $data);
	}

	/**
	 * Guardar formulario de percepcion
	 * @author BMOTTAG
     * @since 25/11/2021
	 */
	public function save_encuesta_percepcion()
	{
		header('Content-Type: application/json');
		$data = array();
		$msj = "Se guardó la información de la encuesta!";
		if ($this->formulario_model->saveEncuestaPercepcion()) 
		{
			$data["result"] = true;
			$this->session->set_flashdata('retornoExito', $msj);
		} else {
			$data["result"] = "error";
			$data["mensaje"] = "Error!!! Ask for help.";
			$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
		}
		echo json_encode($data);
    }
	
	/**
	 * Formulario de atenciona al ciudadano
	 * @author AOCUBILLOSA
     * @since 19/04/2023
	 */
	public function atencionCiudadano()
	{
		$arrParam = array(
			"table" => "param_tipo_persona",
			"order" => "id_tipo_persona",
			"id" => "x"
		);
		$data['listaTipoPersonas'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_tipo_identificacion",
			"order" => "id_tipo_identificacion",
			"id" => "x"
		);
		$data['listaTipoIdent'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_tipo_entidad",
			"order" => "id_tipo_entidad",
			"id" => "x"
		);
		$data['listaTipoEntidad'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_genero",
			"order" => "id_genero",
			"id" => "x"
		);
		$data['listaGenero'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_tipo_acompanamiento",
			"order" => "id_tipo_acompanamiento",
			"id" => "x"
		);
		$data['listaAcompanamiento'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_condicion",
			"order" => "id_condicion",
			"id" => "x"
		);
		$data['listaCondiciones'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_tipo_atencion",
			"order" => "id_tipo_atencion",
			"id" => "x"
		);
		$data['listaTipoAtencion'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_tema",
			"order" => "id_tema",
			"id" => "x"
		);
		$data['listaTemas'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_localidades",
			"order" => "id_localidad",
			"id" => "x"
		);
		$data['listaLocalidades'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_estrato",
			"order" => "id_estrato",
			"id" => "x"
		);
		$data['listaEstratos'] = $this->general_model->get_basic_search($arrParam);
		$data['view'] = 'form_atencion_ciudadano';
		$this->load->view('layout_calendar', $data);
	}

	/**
     * Buscar Tipo de Sociedad X Tipo de Entidad
     * @author AOCUBILLOSA
     * @since  18/05/2023
     */
    public function listaTipoSociedad() {
        header("Content-Type: text/plain; charset=utf-8"); // Para evitar problemas de acentos
        $identificador = $this->input->post('identificador');
        $lista = $this->formulario_model->get_tipo_sociedad($identificador);
        echo "<option value=''>Seleccione...</option>";
        if ($lista) {
            foreach ($lista as $fila) {
                echo "<option value='" . $fila["id_tipo_sociedad"] . "' >" . $fila["tipo_sociedad"] . "</option>";
            }
        }
    }

    /**
     * Buscar UPZ X Localidad
     * @author AOCUBILLOSA
     * @since  18/05/2023
     */
    public function listaUPZ() {
        header("Content-Type: text/plain; charset=utf-8"); // Para evitar problemas de acentos
        $identificador = $this->input->post('identificador');
        $lista = $this->formulario_model->get_lista_upz($identificador);
        echo "<option value=''>Seleccione...</option>";
        if ($lista) {
            foreach ($lista as $fila) {
                echo "<option value='" . $fila["id_upz"] . "' >" . $fila["id_upz"] . ' - ' . $fila["upz"] . "</option>";
            }
        }
    }

    /**
     * Buscar Barrio X UPZ
     * @author AOCUBILLOSA
     * @since  18/05/2023
     */
    public function listaBarrios() {
        header("Content-Type: text/plain; charset=utf-8"); // Para evitar problemas de acentos
        $identificador = $this->input->post('identificador');
        $lista = $this->formulario_model->get_lista_barrios($identificador);
        echo "<option value=''>Seleccione...</option>";
        if ($lista) {
            foreach ($lista as $fila) {
                echo "<option value='" . $fila["id_barrio"] . "' >" . $fila["barrio"] . "</option>";
            }
        }
    }

    /**
	 * Save formulario de pqrs
	 * @author AOCUBILLOSA
     * @since 18/05/2023
	 */
    function enviar_informacion()
	{
		$autoriza = $this->input->post('autoriza');
		if($autoriza == 1) {
			$autoriza = 'Si';
		} else if($autoriza == 2) {
			$autoriza = 'No';
		}
		$tipo_persona = $this->input->post('tipo_persona');
		if(!empty($tipo_persona)) {
			$arrParam = array(
				"table" => "param_tipo_persona",
				"order" => "id_tipo_persona",
				"column" => "id_tipo_persona",
				"id" => $tipo_persona
			);
			$tipoPersona = $this->general_model->get_basic_search($arrParam);
			$tipo_persona = $tipoPersona[0]['tipo_persona'];
		}
		$tipo_ident = $this->input->post('tipo_ident');
		if(!empty($tipo_ident)) {
			$arrParam = array(
				"table" => "param_tipo_identificacion",
				"order" => "id_tipo_identificacion",
				"column" => "id_tipo_identificacion",
				"id" => $tipo_ident
			);
			$tipoIdent = $this->general_model->get_basic_search($arrParam);
			$tipo_ident = $tipoIdent[0]['tipo_identificacion'];
		}
		$tipo_entidad = $this->input->post('tipo_entidad');
		if(!empty($tipo_entidad)) {
			$arrParam = array(
				"table" => "param_tipo_entidad",
				"order" => "id_tipo_entidad",
				"column" => "id_tipo_entidad",
				"id" => $tipo_entidad
			);
			$tipoEntidad = $this->general_model->get_basic_search($arrParam);
			$tipo_entidad = $tipoEntidad[0]['tipo_entidad'];
		}
		$tipo_sociedad = $this->input->post('tipo_sociedad');
		if(!empty($tipo_sociedad)) {
			$arrParam = array(
				"table" => "param_tipo_sociedad",
				"order" => "id_tipo_sociedad",
				"column" => "id_tipo_sociedad",
				"id" => $tipo_sociedad
			);
			$tipoSociedad = $this->general_model->get_basic_search($arrParam);
			$tipo_sociedad = $tipoSociedad[0]['tipo_sociedad'];
		}
		$documento = $this->input->post('documento');
		$tipo_genero = $this->input->post('tipo_genero');
		if(!empty($tipo_genero)) {
			$arrParam = array(
				"table" => "param_genero",
				"order" => "id_genero",
				"column" => "id_genero",
				"id" => $tipo_genero
			);
			$tipoGenero = $this->general_model->get_basic_search($arrParam);
			$tipo_genero = $tipoGenero[0]['genero'];
		}
		$fecha_nac = $this->input->post('fecha_nacimiento');
		$tipo_acompanamiento = $this->input->post('tipo_acompanamiento');
		if(!empty($tipo_acompanamiento)) {
			$arrParam = array(
				"table" => "param_tipo_acompanamiento",
				"order" => "id_tipo_acompanamiento",
				"column" => "id_tipo_acompanamiento",
				"id" => $tipo_acompanamiento
			);
			$tipoAcompanamiento = $this->general_model->get_basic_search($arrParam);
			$tipo_acompanamiento = $tipoAcompanamiento[0]['tipo_acompanamiento'];
		}
		$edad = $this->input->post('edad');
		$nombres = $this->input->post('nombres');
		$apellidos = $this->input->post('apellidos');
		$razon_social = $this->input->post('nombre_est');
		$telefono = $this->input->post('telefono');
		$email = $this->input->post('email');
		$condicion = $this->input->post('condicion');
		if(!empty($condicion)) {
			$arrParam = array(
				"table" => "param_condicion",
				"order" => "id_condicion",
				"column" => "id_condicion",
				"id" => $condicion
			);
			$tipoCondicion = $this->general_model->get_basic_search($arrParam);
			$condicion = $tipoCondicion[0]['condicion'];
		}
		$entidad_distrital = $this->input->post('entidadDistrital');
		if($entidad_distrital == 1) {
			$entidad_distrital = 'Si';
		} else if($entidad_distrital == 2) {
			$entidad_distrital = 'No';
		}
		$asunto = $this->input->post('asunto');
		$tipo_atencion = $this->input->post('tipo_atencion');
		if(!empty($tipo_atencion)) {
			$arrParam = array(
				"table" => "param_tipo_atencion",
				"order" => "id_tipo_atencion",
				"column" => "id_tipo_atencion",
				"id" => $tipo_atencion
			);
			$tipoAtencion = $this->general_model->get_basic_search($arrParam);
			$tipo_atencion = $tipoAtencion[0]['tipo_atencion'];
		}
		$palabra_clave = $this->input->post('palabra_clave');
		$tema = $this->input->post('tema');
		if(!empty($tema)) {
			$arrParam = array(
				"table" => "param_tema",
				"order" => "id_tema",
				"column" => "id_tema",
				"id" => $tema
			);
			$tipoTema = $this->general_model->get_basic_search($arrParam);
			$tema = $tipoTema[0]['tema'];
		}
		$localidad = $this->input->post('localidad');
		if(!empty($localidad)) {
			$arrParam = array(
				"table" => "param_localidades",
				"order" => "id_localidad",
				"column" => "id_localidad",
				"id" => $localidad
			);
			$tipoLocalidad = $this->general_model->get_basic_search($arrParam);
			$localidad = $tipoLocalidad[0]['localidad'];
		}
		$upz = $this->input->post('upz');
		if(!empty($upz)) {
			$arrParam = array(
				"table" => "param_upz",
				"order" => "id_upz",
				"column" => "id_upz",
				"id" => $upz
			);
			$tipoUPZ = $this->general_model->get_basic_search($arrParam);
			$upz = $tipoUPZ[0]['upz'];
		}
		$barrio = $this->input->post('barrio');
		if(!empty($barrio)) {
			$arrParam = array(
				"table" => "param_barrios",
				"order" => "id_barrio",
				"column" => "id_barrio",
				"id" => $barrio
			);
			$tipoLocalidad = $this->general_model->get_basic_search($arrParam);
			$barrio = $tipoLocalidad[0]['barrio'];
		}
		$direccion = $this->input->post('direccion');
		$estrato = $this->input->post('estrato');
		$codigo_postal = $this->input->post('codigo_postal');
		$confirmar = $this->input->post('confirmar');
		if($confirmar == 'on') {
			$confirmar = 'Si';
		} else if ($confirmar == 'off') {
			$confirmar = 'No';
		}
		// Configuracion encabezado correo
		//$to = "andres.cubillos@jbb.gov.co";
		$to = "correspondenciajbb@jbb.gov.co";
		$arrParam2 = array(
			"table" => "parametros",
			"order" => "id_parametro",
			"id" => "x"
		);
		$parametric = $this->general_model->get_basic_search($arrParam2);
		$paramHost = $parametric[0]["parametro_valor"];
		$paramUsername = $parametric[1]["parametro_valor"];
		$paramPassword = $parametric[2]["parametro_valor"];
		$paramFromName = $parametric[3]["parametro_valor"];
		$paramCompanyName = $parametric[4]["parametro_valor"];
		$paramAPPName = $parametric[5]["parametro_valor"];
		// Configuracion cargue de archivo
		$num = rand(100000,999999);
		$config['upload_path'] = './files/';
		$config['overwrite'] = TRUE;
		$config['allowed_types'] = 'pdf|txt|doc|docx|xls|xlsx|png|jpg|jpeg|rar|zip';
		$config['max_size'] = '3048';
		$config['max_width'] = '2024';
		$config['max_height'] = '2024';
		$config['file_name'] = date('Y') .''. date('m') .''. date('d') .''. date('H') .''. date('i') .''. date('s') .''. $num;
		$this->load->library('upload', $config);
		if ($_FILES['userfile']['name'] != "") {
			if (!$this->upload->do_upload()) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('retornoError', html_escape(substr($error, 3, -4)));
			} else {
				$file_info = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
				$path = $file_info['file_name'];
				if ($this->formulario_model->saveFormularioPQRSD($path)) {
					// Mensaje del correo
					$msj = 'DATOS DEL SOLICITANTE</br></br>';
					$msj .= '<strong>Autoriza el Tratamiento de Datos Personales: </strong>' . $autoriza . '</br>';
					if ($this->input->post('autoriza') == 1) {
						$msj .= '<strong>Tipo de Persona: </strong>' . $tipo_persona . '</br>';
						if ($this->input->post('tipo_persona') == 1) {
							$msj .= '<strong>Tipo de Identificación: </strong>' . $tipo_ident . '</br>';
							$msj .= '<strong>Número de Documento: </strong>' . $documento . '</br>';
							$msj .= '<strong>Genero: </strong>' . $tipo_genero . '</br>';
							$msj .= '<strong>Fecha de Nacimiento: </strong>' . $fecha_nac . '</br>';
							$msj .= '<strong>Nombres: </strong>' . $nombres . '</br>';
							$msj .= '<strong>Apellidos: </strong>' . $apellidos . '</br>';
							$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
							$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
							$msj .= '<strong>Condición: </strong>' . $condicion . '</br>';
							$msj .= '<strong>Pertenece a una Entidad Distrital: </strong>' . $entidad_distrital . '</br>';
						}
						else if ($this->input->post('tipo_persona') == 2) {
							$msj .= '<strong>Tipo de Identificación: </strong>NIT</br>';
							$msj .= '<strong>Número de Documento: </strong>' . $documento . '</br>';
							$msj .= '<strong>Tipo de Entidad: </strong>' . $tipo_entidad . '</br>';
							$msj .= '<strong>Tipo de Empresa/Sociedad: </strong>' . $tipo_sociedad . '</br>';
							$msj .= '<strong>Razón Social: </strong>' . $razon_social . '</br>';
							$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
							$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
						}
						else if ($this->input->post('tipo_persona') == 3) {
							$msj .= '<strong>Tipo de Identificación: </strong>NIT</br>';
							$msj .= '<strong>Número de Documento: </strong>' . $documento . '</br>';
							$msj .= '<strong>Razón Social: </strong>' . $razon_social . '</br>';
							$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
							$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
						}
						else if ($this->input->post('tipo_persona') == 4) {
							$msj .= '<strong>Quien Realiza Acompañamiento: </strong>' . $tipo_acompanamiento . '</br>';
							$msj .= '<strong>Edad: </strong>' . $edad . '</br>';
							$msj .= '<strong>Nombres: </strong>' . $nombres . '</br>';
							$msj .= '<strong>Apellidos: </strong>' . $apellidos . '</br>';
							$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
							$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
						}
						else if ($this->input->post('tipo_persona') == 5) {
							$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
							$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
							$msj .= '<strong>Condición: </strong>' . $condicion . '</br>';
							$msj .= '<strong>Pertenece a una Entidad Distrital: </strong>' . $entidad_distrital . '</br>';
						}
					}
					$msj .= '<strong>Tipo de Petición: </strong>' . $tipo_atencion . '</br>';
					$msj .= '<strong>Palabra Clave: </strong>' . $palabra_clave . '</br>';
					$msj .= '<strong>Tema: </strong>' . $tema . '</br>';
					$msj .= '<strong>Localidad: </strong>' . $localidad . '</br>';
					$msj .= '<strong>UPZ: </strong>' . $upz . '</br>';
					$msj .= '<strong>Barrio: </strong>' . $barrio . '</br>';
					$msj .= '<strong>Dirección: </strong>' . $direccion . '</br>';
					$msj .= '<strong>Estrato: </strong>' . $estrato . '</br>';
					$msj .= '<strong>Código Postal: </strong>' . $codigo_postal . '</br>';
					$msj .= '<strong>Certifica Información: </strong>' . $confirmar . '</br></br>';
					$msj .= '<strong>Asunto: </strong>' . $asunto . '</br>';
					$mensaje = "<p>$msj</p><br>";
					$mensaje .= "<p>Cordialmente,<br><strong>$paramCompanyName</strong></p>";
					// Configuracion envio de ccorreo
					require_once(APPPATH.'libraries/PHPMailer_5.2.4/class.phpmailer.php');
			        $mail = new PHPMailer(true);
			        $mail->IsSMTP(); // Set mailer to use SMTP
			        $mail->Host = $paramHost; // Specif SMTP server
			        $mail->SMTPSecure= "tls"; // Used instead of TLS when only POP mail is selected
			        $mail->Port = 587; // Used instead of 587 when only POP mail is selected
			        $mail->SMTPAuth = true;
					$mail->Username = $paramUsername; // SMTP username
			        $mail->Password = $paramPassword; // SMTP password
			        $mail->FromName = $paramFromName;
			        $mail->From = $paramUsername;
			        $mail->AddAddress($to, $paramAPPName);
			        $mail->WordWrap = 50;
			        $mail->CharSet = 'UTF-8';
			        $mail->IsHTML(true); // Set email format to HTML
			        $mail->Subject = $paramAPPName . ' - ' . $paramCompanyName;
			        $mail->Body = nl2br($mensaje, false);
			        $mail->AddAttachment($_FILES['userfile']['tmp_name'], $_FILES['userfile']['name']);
					if ($mail->Send()) {
						$this->session->set_flashdata('retornoExito', 'Se registraron sus respuestas.<br><br>Gracias por brindarnos su opinión sobre la atención recibida.');
					} else {
						$this->session->set_flashdata('retornoError', '<strong>Error:</strong> Ocurrio algun error en el envio del email.');
					}
				} else {
					$this->session->set_flashdata('retornoError', '<strong>Error:</strong> Ocurrio algun error en la base de datos.');
				}
	    	}
		} else {
			if ($this->formulario_model->saveFormularioPQRSD()) {
				// Mensaje del correo
				$msj = 'DATOS DEL SOLICITANTE</br></br>';
				$msj .= '<strong>Autoriza el Tratamiento de Datos Personales: </strong>' . $autoriza . '</br>';
				if ($this->input->post('autoriza') == 1) {
					$msj .= '<strong>Tipo de Persona: </strong>' . $tipo_persona . '</br>';
					if ($this->input->post('tipo_persona') == 1) {
						$msj .= '<strong>Tipo de Identificación: </strong>' . $tipo_ident . '</br>';
						$msj .= '<strong>Número de Documento: </strong>' . $documento . '</br>';
						$msj .= '<strong>Genero: </strong>' . $tipo_genero . '</br>';
						$msj .= '<strong>Fecha de Nacimiento: </strong>' . $fecha_nac . '</br>';
						$msj .= '<strong>Nombres: </strong>' . $nombres . '</br>';
						$msj .= '<strong>Apellidos: </strong>' . $apellidos . '</br>';
						$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
						$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
						$msj .= '<strong>Condición: </strong>' . $condicion . '</br>';
						$msj .= '<strong>Pertenece a una Entidad Distrital: </strong>' . $entidad_distrital . '</br>';
					}
					else if ($this->input->post('tipo_persona') == 2) {
						$msj .= '<strong>Tipo de Identificación: </strong>NIT</br>';
						$msj .= '<strong>Número de Documento: </strong>' . $documento . '</br>';
						$msj .= '<strong>Tipo de Entidad: </strong>' . $tipo_entidad . '</br>';
						$msj .= '<strong>Tipo de Empresa/Sociedad: </strong>' . $tipo_sociedad . '</br>';
						$msj .= '<strong>Razón Social: </strong>' . $razon_social . '</br>';
						$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
						$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
					}
					else if ($this->input->post('tipo_persona') == 3) {
						$msj .= '<strong>Tipo de Identificación: </strong>NIT</br>';
						$msj .= '<strong>Número de Documento: </strong>' . $documento . '</br>';
						$msj .= '<strong>Razón Social: </strong>' . $razon_social . '</br>';
						$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
						$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
					}
					else if ($this->input->post('tipo_persona') == 4) {
						$msj .= '<strong>Quien Realiza Acompañamiento: </strong>' . $tipo_acompanamiento . '</br>';
						$msj .= '<strong>Edad: </strong>' . $edad . '</br>';
						$msj .= '<strong>Nombres: </strong>' . $nombres . '</br>';
						$msj .= '<strong>Apellidos: </strong>' . $apellidos . '</br>';
						$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
						$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
					}
					else if ($this->input->post('tipo_persona') == 5) {
						$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
						$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
						$msj .= '<strong>Condición: </strong>' . $condicion . '</br>';
						$msj .= '<strong>Pertenece a una Entidad Distrital: </strong>' . $entidad_distrital . '</br>';
					}
				}
				$msj .= '<strong>Tipo de Petición: </strong>' . $tipo_atencion . '</br>';
				$msj .= '<strong>Palabra Clave: </strong>' . $palabra_clave . '</br>';
				$msj .= '<strong>Tema: </strong>' . $tema . '</br>';
				$msj .= '<strong>Localidad: </strong>' . $localidad . '</br>';
				$msj .= '<strong>UPZ: </strong>' . $upz . '</br>';
				$msj .= '<strong>Barrio: </strong>' . $barrio . '</br>';
				$msj .= '<strong>Dirección: </strong>' . $direccion . '</br>';
				$msj .= '<strong>Estrato: </strong>' . $estrato . '</br>';
				$msj .= '<strong>Código Postal: </strong>' . $codigo_postal . '</br>';
				$msj .= '<strong>Certifica Información: </strong>' . $confirmar . '</br></br>';
				$msj .= '<strong>Asunto: </strong>' . $asunto . '</br>';
				$mensaje = "<p>$msj</p><br>";
				$mensaje .= "<p>Cordialmente,<br><strong>$paramCompanyName</strong></p>";
				// Configuracion envio de ccorreo
				require_once(APPPATH.'libraries/PHPMailer_5.2.4/class.phpmailer.php');
		        $mail = new PHPMailer(true);
		        $mail->IsSMTP(); // Set mailer to use SMTP
		        $mail->Host = $paramHost; // Specif SMTP server
		        $mail->SMTPSecure= "tls"; // Used instead of TLS when only POP mail is selected
		        $mail->Port = 587; // Used instead of 587 when only POP mail is selected
		        $mail->SMTPAuth = true;
				$mail->Username = $paramUsername; // SMTP username
		        $mail->Password = $paramPassword; // SMTP password
		        $mail->FromName = $paramFromName;
		        $mail->From = $paramUsername;
		        $mail->AddAddress($to, $paramAPPName);
		        $mail->WordWrap = 50;
		        $mail->CharSet = 'UTF-8';
		        $mail->IsHTML(true); // Set email format to HTML
		        $mail->Subject = $paramAPPName . ' - ' . $paramCompanyName;
		        $mail->Body = nl2br($mensaje, false);
				if ($mail->Send()) {
					$this->session->set_flashdata('retornoExito', 'Se registraron sus respuestas.<br><br>Gracias por brindarnos su opinión sobre la atención recibida.');
				} else {
					$this->session->set_flashdata('retornoError', '<strong>Error:</strong> Ocurrio algun error en el envio del email.');
				}
			} else {
				$this->session->set_flashdata('retornoError', '<strong>Error:</strong> Ocurrio algun error en la base de datos.');
			}
		}
    	redirect('formulario/formMensaje');
    }

    /**
	 * Save formulario de pqrs
	 * @author AOCUBILLOSA
     * @since 18/05/2023
	 */
    function formMensaje()
	{
		$data['view'] = 'form_mensaje';
		$this->load->view('layout_calendar', $data);
		header("refresh:5; url=atencionCiudadano");
	}

	/**
	 * Formulario de ventanilla virtual
	 * @author AOCUBILLOSA
     * @since 16/07/2023
	 */
	public function ventanillaVirtual()
	{
		$data['listaTipoPersonas'] = $this->formulario_model->get_tipo_persona();
		$arrParam = array(
			"table" => "param_tipo_identificacion",
			"order" => "id_tipo_identificacion",
			"id" => "x"
		);
		$data['listaTipoIdent'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_tipo_entidad",
			"order" => "id_tipo_entidad",
			"id" => "x"
		);
		$data['listaTipoEntidad'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_genero",
			"order" => "id_genero",
			"id" => "x"
		);
		$data['listaGenero'] = $this->general_model->get_basic_search($arrParam);
		$arrParam = array(
			"table" => "param_tipo_atencion",
			"order" => "id_tipo_atencion",
			"id" => "x"
		);
		$data['listaTipoAtencion'] = $this->general_model->get_basic_search($arrParam);
		$data['view'] = 'form_ventanilla_virtual';
		$this->load->view('layout_calendar', $data);
	}

	/**
	 * Save formulario de ventanilla virtual
	 * @author AOCUBILLOSA
     * @since 30/07/2023
	 */
    function enviar_info_ventanillaVirtual()
	{
		$autoriza = $this->input->post('autoriza');
		if($autoriza == 1) {
			$autoriza = 'Si';
		} else if($autoriza == 2) {
			$autoriza = 'No';
		}
		$tipo_persona = $this->input->post('tipo_persona');
		if(!empty($tipo_persona)) {
			$arrParam = array(
				"table" => "param_tipo_persona",
				"order" => "id_tipo_persona",
				"column" => "id_tipo_persona",
				"id" => $tipo_persona
			);
			$tipoPersona = $this->general_model->get_basic_search($arrParam);
			$tipo_persona = $tipoPersona[0]['tipo_persona'];
		}
		$tipo_ident = $this->input->post('tipo_ident');
		if(!empty($tipo_ident)) {
			$arrParam = array(
				"table" => "param_tipo_identificacion",
				"order" => "id_tipo_identificacion",
				"column" => "id_tipo_identificacion",
				"id" => $tipo_ident
			);
			$tipoIdent = $this->general_model->get_basic_search($arrParam);
			$tipo_ident = $tipoIdent[0]['tipo_identificacion'];
		}
		$tipo_entidad = $this->input->post('tipo_entidad');
		if(!empty($tipo_entidad)) {
			$arrParam = array(
				"table" => "param_tipo_entidad",
				"order" => "id_tipo_entidad",
				"column" => "id_tipo_entidad",
				"id" => $tipo_entidad
			);
			$tipoEntidad = $this->general_model->get_basic_search($arrParam);
			$tipo_entidad = $tipoEntidad[0]['tipo_entidad'];
		}
		$tipo_sociedad = $this->input->post('tipo_sociedad');
		if(!empty($tipo_sociedad)) {
			$arrParam = array(
				"table" => "param_tipo_sociedad",
				"order" => "id_tipo_sociedad",
				"column" => "id_tipo_sociedad",
				"id" => $tipo_sociedad
			);
			$tipoSociedad = $this->general_model->get_basic_search($arrParam);
			$tipo_sociedad = $tipoSociedad[0]['tipo_sociedad'];
		}
		$documento = $this->input->post('documento');
		$tipo_genero = $this->input->post('tipo_genero');
		if(!empty($tipo_genero)) {
			$arrParam = array(
				"table" => "param_genero",
				"order" => "id_genero",
				"column" => "id_genero",
				"id" => $tipo_genero
			);
			$tipoGenero = $this->general_model->get_basic_search($arrParam);
			$tipo_genero = $tipoGenero[0]['genero'];
		}
		$fecha_nac = $this->input->post('fecha_nacimiento');
		$nombres = $this->input->post('nombres');
		$apellidos = $this->input->post('apellidos');
		$razon_social = $this->input->post('nombre_est');
		$telefono = $this->input->post('telefono');
		$email = $this->input->post('email');
		$direccion = $this->input->post('direccion');
		$tipo_atencion = $this->input->post('tipo_atencion');
		if(!empty($tipo_atencion)) {
			$arrParam = array(
				"table" => "param_tipo_atencion",
				"order" => "id_tipo_atencion",
				"column" => "id_tipo_atencion",
				"id" => $tipo_atencion
			);
			$tipoAtencion = $this->general_model->get_basic_search($arrParam);
			$tipo_atencion = $tipoAtencion[0]['tipo_atencion'];
		}
		$asunto = $this->input->post('asunto');
		// Configuracion encabezado correo
		//$to = "andres.cubillos@jbb.gov.co";
		$to = "correspondenciajbb@jbb.gov.co";
		$arrParam2 = array(
			"table" => "parametros",
			"order" => "id_parametro",
			"id" => "x"
		);
		$parametric = $this->general_model->get_basic_search($arrParam2);
		$paramHost = $parametric[0]["parametro_valor"];
		$paramUsername = $parametric[1]["parametro_valor"];
		$paramPassword = $parametric[2]["parametro_valor"];
		$paramFromName = $parametric[3]["parametro_valor"];
		$paramCompanyName = $parametric[4]["parametro_valor"];
		$paramAPPName = $parametric[6]["parametro_valor"];
		// Configuracion cargue de archivos
		$ext_1 = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
		$ext_2 = pathinfo($_FILES['anexos']['name'], PATHINFO_EXTENSION);
		if ($ext_1 == 'txt' || $ext_1 == 'doc' || $ext_1 == 'docx' || $ext_1 == 'xls' || $ext_1 == 'xlsx' || $ext_1 == 'png' || $ext_1 == 'jpg' || $ext_1 == 'jpeg' || $ext_1 == 'rar' || $ext_1 == 'zip' || $ext_2 == 'pdf') {
			$error = 'El tipo de archivo que esta tratando de subir no está permitido';
			$this->session->set_flashdata('retornoError', $error);
		} else {
			$num1 = rand(100000,999999);
			$config['upload_path'] = './files/ventanilla/';
			$config['overwrite'] = TRUE;
			$config['allowed_types'] = 'pdf|txt|doc|docx|xls|xlsx|png|jpg|jpeg|rar|zip';
			$config['max_size'] = '4096';
			$config['max_width'] = '2024';
			$config['max_height'] = '2024';
			$config['file_name'] = date('Y') .''. date('m') .''. date('d') .''. date('H') .''. date('i') .''. date('s') .''. $num1;
			$this->load->library('upload', $config);
			if ($_FILES['userfile']['name'] != "") {
				if (!$this->upload->do_upload('userfile')) {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('retornoError', html_escape(substr($error, 3, -4)));
				} else {
					$file_info = $this->upload->data();
					$data = array('upload_data' => $this->upload->data());
					$path = $file_info['file_name'];
					if ($_FILES['anexos']['name'] != "") {
						if (!$this->upload->do_upload('anexos')) {
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('retornoError', html_escape(substr($error, 3, -4)));
							unlink(FCPATH . './files/ventanilla/' . $path);
						} else {
							$file_info2 = $this->upload->data();
							$data = array('upload_data' => $this->upload->data());
							$anexos = $file_info2['file_name'];

							if ($this->formulario_model->saveVentanillaVirtual($path, $anexos)) {
								// Mensaje del correo
								$msj = 'DATOS DEL SOLICITANTE</br></br>';
								$msj .= '<strong>Autoriza el Tratamiento de Datos Personales: </strong>' . $autoriza . '</br>';
								if ($this->input->post('autoriza') == 1) {
									$msj .= '<strong>Tipo de Persona: </strong>' . $tipo_persona . '</br>';
									if ($this->input->post('tipo_persona') == 1) {
										$msj .= '<strong>Tipo de Identificación: </strong>' . $tipo_ident . '</br>';
										$msj .= '<strong>Número de Documento: </strong>' . $documento . '</br>';
										$msj .= '<strong>Genero: </strong>' . $tipo_genero . '</br>';
										$msj .= '<strong>Fecha de Nacimiento: </strong>' . $fecha_nac . '</br>';
										$msj .= '<strong>Nombres: </strong>' . $nombres . '</br>';
										$msj .= '<strong>Apellidos: </strong>' . $apellidos . '</br>';
										$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
										$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
										$msj .= '<strong>Dirección: </strong>' . $direccion . '</br>';
									}
									else if ($this->input->post('tipo_persona') == 2) {
										$msj .= '<strong>Tipo de Identificación: </strong>NIT</br>';
										$msj .= '<strong>Número de Documento: </strong>' . $documento . '</br>';
										$msj .= '<strong>Tipo de Entidad: </strong>' . $tipo_entidad . '</br>';
										$msj .= '<strong>Tipo de Empresa/Sociedad: </strong>' . $tipo_sociedad . '</br>';
										$msj .= '<strong>Razón Social: </strong>' . $razon_social . '</br>';
										$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
										$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
										$msj .= '<strong>Dirección: </strong>' . $direccion . '</br>';
									}
								}
								$msj .= '<strong>Tipo de Petición: </strong>' . $tipo_atencion . '</br>';
								$msj .= '<strong>Asunto: </strong>' . $asunto . '</br>';
								$mensaje = "<p>$msj</p><br>";
								$mensaje .= "<p>Cordialmente,<br><strong>$paramCompanyName</strong></p>";
								// Configuracion envio de ccorreo
								require_once(APPPATH.'libraries/PHPMailer_5.2.4/class.phpmailer.php');
						        $mail = new PHPMailer(true);
						        $mail->IsSMTP(); // Set mailer to use SMTP
						        $mail->Host = $paramHost; // Specif SMTP server
						        $mail->SMTPSecure= "tls"; // Used instead of TLS when only POP mail is selected
						        $mail->Port = 587; // Used instead of 587 when only POP mail is selected
						        $mail->SMTPAuth = true;
								$mail->Username = $paramUsername; // SMTP username
						        $mail->Password = $paramPassword; // SMTP password
						        $mail->FromName = $paramFromName;
						        $mail->From = $paramUsername;
						        $mail->AddAddress($to, $paramAPPName);
						        $mail->WordWrap = 50;
						        $mail->CharSet = 'UTF-8';
						        $mail->IsHTML(true); // Set email format to HTML
						        $mail->Subject = $paramAPPName . ' - ' . $paramCompanyName;
						        $mail->Body = nl2br($mensaje, false);
						        $mail->AddAttachment($_FILES['userfile']['tmp_name'], $_FILES['userfile']['name']);
						        $mail->AddAttachment($_FILES['anexos']['tmp_name'], $_FILES['anexos']['name']);
								if ($mail->Send()) {
									$this->session->set_flashdata('retornoExito', 'Se registraron sus respuestas.<br><br>Gracias por brindarnos su opinión sobre la atención recibida.');
								} else {
									$this->session->set_flashdata('retornoError', '<strong>Error:</strong> Ocurrio algun error en el envio del email.');
								}
							} else {
								$this->session->set_flashdata('retornoError', '<strong>Error:</strong> Ocurrio algun error en la base de datos.');
							}
						}
					} else {
						if ($this->formulario_model->saveVentanillaVirtual($path)) {
							// Mensaje del correo
							$msj = 'DATOS DEL SOLICITANTE</br></br>';
							$msj .= '<strong>Autoriza el Tratamiento de Datos Personales: </strong>' . $autoriza . '</br>';
							if ($this->input->post('autoriza') == 1) {
								$msj .= '<strong>Tipo de Persona: </strong>' . $tipo_persona . '</br>';
								if ($this->input->post('tipo_persona') == 1) {
									$msj .= '<strong>Tipo de Identificación: </strong>' . $tipo_ident . '</br>';
									$msj .= '<strong>Número de Documento: </strong>' . $documento . '</br>';
									$msj .= '<strong>Genero: </strong>' . $tipo_genero . '</br>';
									$msj .= '<strong>Fecha de Nacimiento: </strong>' . $fecha_nac . '</br>';
									$msj .= '<strong>Nombres: </strong>' . $nombres . '</br>';
									$msj .= '<strong>Apellidos: </strong>' . $apellidos . '</br>';
									$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
									$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
									$msj .= '<strong>Dirección: </strong>' . $direccion . '</br>';
								}
								else if ($this->input->post('tipo_persona') == 2) {
									$msj .= '<strong>Tipo de Identificación: </strong>NIT</br>';
									$msj .= '<strong>Número de Documento: </strong>' . $documento . '</br>';
									$msj .= '<strong>Tipo de Entidad: </strong>' . $tipo_entidad . '</br>';
									$msj .= '<strong>Tipo de Empresa/Sociedad: </strong>' . $tipo_sociedad . '</br>';
									$msj .= '<strong>Razón Social: </strong>' . $razon_social . '</br>';
									$msj .= '<strong>Teléfono: </strong>' . $telefono . '</br>';
									$msj .= '<strong>Correo Electrónico: </strong>' . $email . '</br>';
									$msj .= '<strong>Dirección: </strong>' . $direccion . '</br>';
								}
							}
							$msj .= '<strong>Tipo de Petición: </strong>' . $tipo_atencion . '</br>';
							$msj .= '<strong>Asunto: </strong>' . $asunto . '</br>';
							$mensaje = "<p>$msj</p><br>";
							$mensaje .= "<p>Cordialmente,<br><strong>$paramCompanyName</strong></p>";
							// Configuracion envio de ccorreo
							require_once(APPPATH.'libraries/PHPMailer_5.2.4/class.phpmailer.php');
					        $mail = new PHPMailer(true);
					        $mail->IsSMTP(); // Set mailer to use SMTP
					        $mail->Host = $paramHost; // Specif SMTP server
					        $mail->SMTPSecure= "tls"; // Used instead of TLS when only POP mail is selected
					        $mail->Port = 587; // Used instead of 587 when only POP mail is selected
					        $mail->SMTPAuth = true;
							$mail->Username = $paramUsername; // SMTP username
					        $mail->Password = $paramPassword; // SMTP password
					        $mail->FromName = $paramFromName;
					        $mail->From = $paramUsername;
					        $mail->AddAddress($to, $paramAPPName);
					        $mail->WordWrap = 50;
					        $mail->CharSet = 'UTF-8';
					        $mail->IsHTML(true); // Set email format to HTML
					        $mail->Subject = $paramAPPName . ' - ' . $paramCompanyName;
					        $mail->Body = nl2br($mensaje, false);
					        $mail->AddAttachment($_FILES['userfile']['tmp_name'], $_FILES['userfile']['name']);
							if ($mail->Send()) {
								$this->session->set_flashdata('retornoExito', 'Se registraron sus respuestas.<br><br>Gracias por brindarnos su opinión sobre la atención recibida.');
							} else {
								$this->session->set_flashdata('retornoError', '<strong>Error:</strong> Ocurrio algun error en el envio del email.');
							}
						} else {
							$this->session->set_flashdata('retornoError', '<strong>Error:</strong> Ocurrio algun error en la base de datos.');
						}
					}
				}
			}
		}
    	redirect('formulario/formMensajeVentanilla');
    }

    /**
	 * Save formulario ventanilla virtual
	 * @author AOCUBILLOSA
     * @since 18/05/2023
	 */
    function formMensajeVentanilla()
	{
		$data['view'] = 'form_mensaje';
		$this->load->view('layout_calendar', $data);
		header("refresh:5; url=ventanillaVirtual");
	}
}