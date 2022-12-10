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
     * @since 27/6/2021
     * @author BMOTTAG
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
     * @since 25/11/2021
     * @author BMOTTAG
	 */
	public function percepcion()
	{				
			$arrParam = array(
				"table" => "param_localidades",
				"order" => "localidad",
				"id" => "x"
			);
			$data['listaLocalidades'] = $this->general_model->get_basic_search($arrParam);

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
     * @since 25/11/2021
     * @author BMOTTAG
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
	
	
}