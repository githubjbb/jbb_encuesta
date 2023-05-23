<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Reportes_model extends CI_Model {
	    
		/**
		 * Consulta listado de encuestas
		 * @since 28/6/2021
		 */
		public function get_encuesta($arrData)
		{
				$this->db->select();
				if (array_key_exists('fecha', $arrData) && $arrData['fecha'] != '') {
					$this->db->like('fecha', $arrData["fecha"]); 
				}
				if (array_key_exists('from', $arrData) && $arrData['from'] != '') {
					$this->db->where('fecha >=', $arrData["from"]);
				}				
				if (array_key_exists('to', $arrData) && $arrData['to'] != '' && $arrData['from'] != '') {
					$this->db->where('fecha <', $arrData["to"]);
				}
				$this->db->order_by('fecha', 'asc');
				$query = $this->db->get('repuestas_formulario');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consulta registros encuenta de percepcion
		 * @since 29/11/2021
		 */
		public function get_enc_percepcion($arrData)
		{
				$this->db->select('P.*, L.localidad, G.grupo_etnico, R.rango_edades');
				$this->db->join('param_localidades L', 'L.id_localidad = P.fk_id_localidad', 'INNER');
				$this->db->join('param_grupo_etnico G', 'G.id_grupo_etnico = P.fk_id_grupo_etnico', 'INNER');
				$this->db->join('param_rango_edades R', 'R.id_rango_edades  = P.fk_id_rango_edad', 'INNER');
				if (array_key_exists('fecha', $arrData) && $arrData['fecha'] != '') {
					$this->db->like('fecha_registro', $arrData["fecha"]); 
				}
				if (array_key_exists('from', $arrData) && $arrData['from'] != '') {
					$this->db->where('fecha_registro >=', $arrData["from"]);
				}				
				if (array_key_exists('to', $arrData) && $arrData['to'] != '' && $arrData['from'] != '') {
					$this->db->where('fecha_registro <', $arrData["to"]);
				}
				$this->db->order_by('fecha_registro', 'asc');
				$query = $this->db->get('respuestas_encuesta_percepcion P');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consulta registros encuenta de percepcion
		 * @since 20/05/2023
		 */
		public function get_info_form_atencion($arrData)
		{
				$this->db->select('P.*, tipo_persona, tipo_identificacion, tipo_entidad, tipo_sociedad, genero, condicion, tipo_atencion, tema, localidad, upz, barrio');
				$this->db->join('param_tipo_persona TP', 'TP.id_tipo_persona = P.fk_id_tipo_persona', 'INNER');
				$this->db->join('param_tipo_identificacion TI', 'TI.id_tipo_identificacion = P.fk_id_tipo_identificacion', 'LEFT');
				$this->db->join('param_tipo_entidad TE', 'TE.id_tipo_entidad = P.fk_id_tipo_entidad', 'LEFT');
				$this->db->join('param_tipo_sociedad TS', 'TS.id_tipo_sociedad = P.fk_id_tipo_sociedad', 'LEFT');
				$this->db->join('param_genero G', 'G.id_genero = P.fk_id_genero', 'LEFT');
				$this->db->join('param_condicion C', 'C.id_condicion = P.fk_id_condicion', 'LEFT');
				$this->db->join('param_tipo_atencion TA', 'TA.id_tipo_atencion = P.fk_id_tipo_atencion', 'INNER');
				$this->db->join('param_tema T', 'T.id_tema = P.fk_id_tema', 'INNER');
				$this->db->join('param_localidades L', 'L.id_localidad = P.fk_id_localidad', 'INNER');
				$this->db->join('param_upz U', 'U.id_upz = P.fk_id_upz', 'INNER');
				$this->db->join('param_barrios B', 'B.id_barrio = P.fk_id_barrio', 'INNER');
				if (array_key_exists('fecha', $arrData) && $arrData['fecha'] != '') {
					$this->db->like('fecha_registro', $arrData["fecha"]); 
				}
				if (array_key_exists('from', $arrData) && $arrData['from'] != '') {
					$this->db->where('fecha_registro >=', $arrData["from"]);
				}				
				if (array_key_exists('to', $arrData) && $arrData['to'] != '' && $arrData['from'] != '') {
					$this->db->where('fecha_registro <', $arrData["to"]);
				}
				$this->db->order_by('fecha_registro', 'asc');
				$query = $this->db->get('formulario_pqrsd P');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
	}