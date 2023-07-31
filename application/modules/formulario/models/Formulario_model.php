<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Formulario_model extends CI_Model {
		
		/**
		 * Guardar respuestas formulario
		 * @author BMOTTAG
		 * @since 27/6/2021
		 */
		public function saveEncuesta()
		{				
			$poblacion_cual =  $this->security->xss_clean($this->input->post('poblacion_cual'));
			$poblacion_cual =  addslashes($poblacion_cual);
			$genero_otro =  $this->security->xss_clean($this->input->post('genero_otro'));
			$genero_otro =  addslashes($genero_otro);
			$localidad =  $this->security->xss_clean($this->input->post('localidad'));
			$localidad =  addslashes($localidad);
			$barrio =  $this->security->xss_clean($this->input->post('barrio'));
			$barrio =  addslashes($barrio);
			$servicio =  $this->security->xss_clean($this->input->post('servicio'));
			$servicio =  addslashes($servicio);
			$servicio_cual =  $this->security->xss_clean($this->input->post('servicio_cual'));
			$servicio_cual =  addslashes($servicio_cual);
			$percepcion =  $this->security->xss_clean($this->input->post('percepcion'));
			$percepcion =  addslashes($percepcion);
			$nombre_servidor =  $this->security->xss_clean($this->input->post('nombre_servidor'));
			$nombre_servidor =  addslashes($nombre_servidor);
			$fecha =  $this->security->xss_clean($this->input->post('fecha'));
			$fecha =  addslashes($fecha);
			$data = array(
				'rango_edad' => $this->input->post('rango_edad'),
				'poblacion_discapacidad' => $this->input->post('poblacion_discapacidad'),
				'poblacion_cual' => $poblacion_cual,
				'poblacion_desplazado' => $this->input->post('poblacion_desplazado'),
				'poblacion_victima' => $this->input->post('poblacion_victima'),
				'poblacion_rom' => $this->input->post('poblacion_rom'),
				'poblacion_indigena' => $this->input->post('poblacion_indigena'),
				'poblacion_raizal' => $this->input->post('poblacion_raizal'),
				'poblacion_ninguna' => $this->input->post('poblacion_ninguna'),
				'genero' => $this->input->post('genero'),
				'genero_otro' => $genero_otro,
				'nacionalidad' => $this->input->post('nacionalidad'),
				'localidad' => $localidad,
				'barrio' => $barrio,
				'servicio' => $servicio,
				'servicio_pagina_web' => $this->input->post('servicio_pagina_web'),
				'servicio_volante' => $this->input->post('servicio_volante'),
				'servicio_television' => $this->input->post('servicio_television'),
				'servicio_redes' => $this->input->post('servicio_redes'),
				'servicio_amigo' => $this->input->post('servicio_amigo'),
				'servicio_correo' => $this->input->post('servicio_correo'),
				'servicio_prensa' => $this->input->post('servicio_prensa'),
				'servicio_radio' => $this->input->post('servicio_radio'),
				'servicio_otro' => $this->input->post('servicio_otro'),
				'servicio_cual' => $servicio_cual,
				'calificacion_1' => $this->input->post('calificacion_1'),
				'calificacion_2' => $this->input->post('calificacion_2'),
				'calificacion_3' => $this->input->post('calificacion_3'),
				'calificacion_4' => $this->input->post('calificacion_4'),
				'calificacion_5' => $this->input->post('calificacion_5'),
				'percepcion' => $percepcion,
				'nombre_servidor' => $nombre_servidor,
				'fecha' => $fecha
			);	
			$query = $this->db->insert('repuestas_formulario', $data);
			if ($query) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Guardar respuestas formulario encuesta persepcion
		 * @author BMOTTAG
		 * @since 29/11/2021
		 */
		public function saveEncuestaPercepcion() 
		{			
			$calificacion_1 = $this->input->post('calificacion_1');
			$calificacion_2 = $this->input->post('calificacion_2');
			$calificacion_2 = $calificacion_1 == 1?9:$calificacion_2;
			$data = array(
				'tratamiento_datos' => $this->input->post('autoriza'),
				'fk_id_localidad' => $this->input->post('id_localidad'),
				'estrato' => $this->input->post('estrato'),
				'genero' => $this->input->post('genero'),
				'fk_id_grupo_etnico' => $this->input->post('id_grupo_etnico'),
				'fk_id_rango_edad' => $this->input->post('id_rango_edades'),
				'pregunta_1' => $this->input->post('calificacion_1'),
				'pregunta_2' => $calificacion_2,
				'pregunta_3' => $this->input->post('calificacion_3'),
				'pregunta_4' => $this->input->post('calificacion_4'),
				'pregunta_5' => $this->input->post('calificacion_5'),
				'pregunta_6' => $this->input->post('calificacion_6'),
				'pregunta_7' => $this->input->post('calificacion_7'),
				'pregunta_8' => $this->input->post('calificacion_8'),
				'pregunta_9' => $this->input->post('calificacion_9'),
				'pregunta_10' => $this->input->post('calificacion_10'),
				'pregunta_11' => $this->input->post('calificacion_11'),
				'pregunta_12' => $this->input->post('calificacion_12'),
				'pregunta_13' => $this->input->post('calificacion_13'),
				'fecha_registro' => date("Y-m-d"),
			);	
			$query = $this->db->insert('respuestas_encuesta_percepcion', $data);
			if ($query) {
				return true;
			} else {
				return false;
			}
		}

		/**
	    * Lista de tipo de sociedad
	    * @author AOCUBILLOSA
	    * @since 18/05/2023
	    */
	    public function get_tipo_sociedad($tipo_entidad) {
	        $sociedades = array();
	        $this->db->select('id_tipo_sociedad, tipo_sociedad');
			$this->db->where('fk_id_tipo_entidad', $tipo_entidad);
			$this->db->order_by('id_tipo_sociedad', 'asc');
			$query = $this->db->get('param_tipo_sociedad');
	        if ($query->num_rows() > 0) {
	            $i = 0;
	            foreach ($query->result() as $row) {
	                $sociedades[$i]["id_tipo_sociedad"] = $row->id_tipo_sociedad;
	                $sociedades[$i]["tipo_sociedad"] = $row->tipo_sociedad;
	                $i++;
	            }
	        }
	        $this->db->close();
	        return $sociedades;
	    }

	    /**
	    * Lista de UPZ
	    * @author AOCUBILLOSA
	    * @since 18/05/2023
	    */
	    public function get_lista_upz($localidad) {
	        $upz = array();
	        $this->db->select('id_upz, upz');
			$this->db->where('fk_id_localidad', $localidad);
			$this->db->order_by('id_upz', 'asc');
			$query = $this->db->get('param_upz');
	        if ($query->num_rows() > 0) {
	            $i = 0;
	            foreach ($query->result() as $row) {
	                $upz[$i]["id_upz"] = $row->id_upz;
	                $upz[$i]["upz"] = $row->upz;
	                $i++;
	            }
	        }
	        $this->db->close();
	        return $upz;
	    }
	    
	    /**
	    * Lista de Barrios
	    * @author AOCUBILLOSA
	    * @since 18/05/2023
	    */
	    public function get_lista_barrios($upz) {
	        $barrios = array();
	        $this->db->select('id_barrio, barrio');
			$this->db->where('fk_id_upz', $upz);
			$this->db->order_by('id_barrio', 'asc');
			$query = $this->db->get('param_barrios');
	        if ($query->num_rows() > 0) {
	            $i = 0;
	            foreach ($query->result() as $row) {
	                $barrios[$i]["id_barrio"] = $row->id_barrio;
	                $barrios[$i]["barrio"] = $row->barrio;
	                $i++;
	            }
	        }
	        $this->db->close();
	        return $barrios;
	    }

	    /**
		 * Guardar informacion formulario PQRSD
		 * @author AOCUBILLOSA
		 * @since 18/05/2023
		 */
		public function saveFormularioPQRSD($path = '')
		{
			$tipo_persona = $this->input->post('tipo_persona');
			$tipo_ident = $this->input->post('tipo_ident');
			$tipo_entidad = $this->input->post('tipo_entidad');
			$tipo_sociedad = $this->input->post('tipo_sociedad');
			$documento = $this->input->post('documento');
			$tipo_genero = $this->input->post('tipo_genero');
			$fecha_nac = $this->input->post('fecha_nacimiento');
			$acompanamiento = $this->input->post('tipo_acompanamiento');
			$edad = $this->input->post('edad');
			$nombres = $this->input->post('nombres');
			$apellidos = $this->input->post('apellidos');
			$razon_social = $this->input->post('nombre_est');
			$telefono = $this->input->post('telefono');
			$email = $this->input->post('email');
			$condicion = $this->input->post('condicion');
			$entidad_distrital = $this->input->post('entidadDistrital');
			$palabra_clave = $this->input->post('palabra_clave');
			$confirmar = $this->input->post('confirmar');
			if (empty($tipo_persona)) {
				$tipo_persona = NULL;
			}
			if (empty($tipo_ident)) {
				$tipo_ident = NULL;
				if ($tipo_persona == 2 || $tipo_persona == 3) {
					$tipo_ident = 3;
				}
			}
			if (empty($tipo_entidad)) {
				$tipo_entidad = NULL;
			}
			if (empty($tipo_sociedad)) {
				$tipo_sociedad = NULL;
			}
			if (empty($documento)) {
				$documento = NULL;
			}
			if (empty($tipo_genero)) {
				$tipo_genero = NULL;
			}
			if (empty($fecha_nac)) {
				$fecha_nac = NULL;
			}
			if (empty($acompanamiento)) {
				$acompanamiento = NULL;
			}
			if (empty($edad)) {
				$edad = NULL;
			}
			if (empty($nombres)) {
				$nombres = NULL;
			}
			if (empty($apellidos)) {
				$apellidos = NULL;
			}
			if (empty($razon_social)) {
				$razon_social = NULL;
			}
			if (empty($telefono)) {
				$telefono = NULL;
			}
			if (empty($email)) {
				$email = NULL;
			}
			if (empty($condicion)) {
				$condicion = NULL;
			}
			if (empty($path)) {
				$path = NULL;
			}
			if (empty($palabra_clave)) {
				$palabra_clave = NULL;
			}
			if (empty($entidad_distrital)) {
				$entidad_distrital = NULL;
			}
			if (empty($codigo_postal)) {
				$codigo_postal = NULL;
			}
			if (!empty($confirmar)) { 
                if ($confirmar == 'on') {
                    $conf = 1;
                }
                else if ($confirmar == 'off') {
                    $conf = 2;
                }
            }
			$data = array(
				'autoriza' => $this->input->post('autoriza'),
				'fk_id_tipo_persona' => $tipo_persona,
				'fk_id_tipo_identificacion' => $tipo_ident,
				'fk_id_tipo_entidad' => $tipo_entidad,
				'fk_id_tipo_sociedad' => $tipo_sociedad,
				'numero_documento' => $documento,
				'fk_id_genero' => $tipo_genero,
				'fecha_nacimiento' => $fecha_nac,
				'fk_id_tipo_acompanamiento' => $acompanamiento,
				'edad' => $edad,
				'nombres' => $nombres,
				'apellidos' => $apellidos,
				'razon_social' => $razon_social,
				'telefono' => $telefono,
				'fk_id_condicion' => $condicion,
				'entidad_distrital' => $entidad_distrital,
				'asunto' => $this->input->post('asunto'),
				'archivo' => $path,
				'fk_id_tipo_atencion' => $this->input->post('tipo_atencion'),
				'palabra_clave' => $palabra_clave,
				'fk_id_tema' => $this->input->post('tema'),
				'email' => $email,
				'fk_id_localidad' => $this->input->post('localidad'),
				'fk_id_upz' => $this->input->post('upz'),
				'fk_id_barrio' => $this->input->post('barrio'),
				'direccion' => $this->input->post('direccion'),
				'estrato' => $this->input->post('estrato'),
				'codigo_postal' => $codigo_postal,
				'confirmar' => $conf,
				'fecha_registro' => date("Y-m-d")
			);
			$query = $this->db->insert('formulario_pqrsd', $data);
			if ($query) {
				return true;
			} else {
				return false;
			}
		}

		/**
	    * Lista tipo persona
	    * @author AOCUBILLOSA
	    * @since 16/07/2023
	    */
	    public function get_tipo_persona() {
	        $this->db->select();
			$this->db->where_in('id_tipo_persona', [1,2]);
			$this->db->order_by('id_tipo_persona', 'asc');
			$query = $this->db->get('param_tipo_persona');
	        if ($query->num_rows() > 0) {
	            return $query->result_array();
	        } else {
				return false;
			}
	    }

	    /**
		 * Guardar informacion formulario ventanilla virtual
		 * @author AOCUBILLOSA
		 * @since 30/07/2023
		 */
		public function saveVentanillaVirtual($path = '', $anexos = '')
		{
			$tipo_persona = $this->input->post('tipo_persona');
			$tipo_ident = $this->input->post('tipo_ident');
			$tipo_entidad = $this->input->post('tipo_entidad');
			$tipo_sociedad = $this->input->post('tipo_sociedad');
			$documento = $this->input->post('documento');
			$tipo_genero = $this->input->post('tipo_genero');
			$fecha_nac = $this->input->post('fecha_nacimiento');
			$nombres = $this->input->post('nombres');
			$apellidos = $this->input->post('apellidos');
			$razon_social = $this->input->post('nombre_est');
			$telefono = $this->input->post('telefono');
			$email = $this->input->post('email');
			$direccion = $this->input->post('direccion');
			if (empty($tipo_persona)) {
				$tipo_persona = NULL;
			}
			if (empty($tipo_ident)) {
				$tipo_ident = NULL;
				if ($tipo_persona == 2) {
					$tipo_ident = 3;
				}
			}
			if (empty($tipo_entidad)) {
				$tipo_entidad = NULL;
			}
			if (empty($tipo_sociedad)) {
				$tipo_sociedad = NULL;
			}
			if (empty($documento)) {
				$documento = NULL;
			}
			if (empty($tipo_genero)) {
				$tipo_genero = NULL;
			}
			if (empty($fecha_nac)) {
				$fecha_nac = NULL;
			}
			if (empty($nombres)) {
				$nombres = NULL;
			}
			if (empty($apellidos)) {
				$apellidos = NULL;
			}
			if (empty($razon_social)) {
				$razon_social = NULL;
			}
			if (empty($telefono)) {
				$telefono = NULL;
			}
			if (empty($email)) {
				$email = NULL;
			}
			if (empty($direccion)) {
				$direccion = NULL;
			}
			if (empty($path)) {
				$path = NULL;
			}
			if (empty($anexos)) {
				$anexos = NULL;
			}
			$data = array(
				'autoriza' => $this->input->post('autoriza'),
				'fk_id_tipo_persona' => $tipo_persona,
				'fk_id_tipo_identificacion' => $tipo_ident,
				'fk_id_tipo_entidad' => $tipo_entidad,
				'fk_id_tipo_sociedad' => $tipo_sociedad,
				'numero_documento' => $documento,
				'fk_id_genero' => $tipo_genero,
				'fecha_nacimiento' => $fecha_nac,
				'nombres' => $nombres,
				'apellidos' => $apellidos,
				'razon_social' => $razon_social,
				'telefono' => $telefono,
				'email' => $email,
				'direccion' => $direccion,
				'fk_id_tipo_atencion' => $this->input->post('tipo_atencion'),
				'asunto' => $this->input->post('asunto'),
				'archivo' => $path,
				'anexos' => $anexos,
				'fecha_registro' => date("Y-m-d")
			);
			$query = $this->db->insert('ventanilla_virtual', $data);
			if ($query) {
				return true;
			} else {
				return false;
			}
		}
	}