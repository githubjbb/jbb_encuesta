<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Reportes_model extends CI_Model {
	    
		/**
		 * Consulta listado de encuestas
		 * @since 28/6/2021
		 */
		public function get_encuesta($arrData)
		{
				$this->db->select();
				if (array_key_exists("fecha", $arrData) && $arrData["fecha"] != '') {
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
		
		
		
		
	    
	}