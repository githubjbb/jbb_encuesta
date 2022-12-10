<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("dashboard_model");
		$this->load->model("general_model");
    }
		
	/**
	 * SUPER ADMIN DASHBOARD
	 */
	public function admin()
	{				
			$arrParam = array(
				'from' => date('Y-m-d')
			);
			$arrParam = array(
				'fecha' => date('Y-m-d')
			);			
			$data['listaFormularios'] = $this->general_model->get_info_formularios($arrParam);
			$data['noFormulariosHOY'] = $data['listaFormularios']?count($data['listaFormularios']):0;

			//calculo numero de visitantes para la semana presente
			if (date('D')=='Mon'){
			     $lunes = date('Y-m-d');
			} else {
			     $lunes = date('Y-m-d', strtotime('last Monday', time()));
			}

			$domingo = strtotime('next Sunday', time());
 			$domingo = date('Y-m-d', $domingo);
 			//le sumo un dia al dia final para que ingrese ese dia en la consulta
			$domingo = date('Y-m-d',strtotime ( '+1 day ' , strtotime ($domingo)));

			$arrParam = array(
				'from' => $lunes,
				'to' => $domingo
			);
			$data['listaFormulariosSEMANA'] = $this->general_model->get_info_formularios($arrParam);
			$data['noFormulariosSEMANA'] = $data['listaFormulariosSEMANA']?count($data['listaFormulariosSEMANA']):0;

			//calculo numero de visitantes para el MES presente
			$month_start = strtotime('first day of this month', time());
			$month_start = date('Y-m-d', $month_start);
			$month_end = strtotime('last day of this month', time());
			$month_end = date('Y-m-d', $month_end);
 			//le sumo un dia al dia final para que ingrese ese dia en la consulta
			$month_end = date('Y-m-d',strtotime ( '+1 day ' , strtotime ($month_end)));

			$arrParam = array(
				'from' => $month_start,
				'to' => $month_end
			);
			$data['listaFormulariosMES'] = $this->general_model->get_info_formularios($arrParam);
			$data['noFormulariosMES'] = $data['listaFormulariosMES']?count($data['listaFormulariosMES']):0;

			$data["view"] = "dashboard";
			$this->load->view("layout_calendar2", $data);
	}

    /**
     * Cargo modal - formulario buscar por fecha
     * @since 29/6/2021
     */
    public function cargarModalBuscar() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
						
			$this->load->view('buscar_modal');
    }

	/**
	 * Buscar por fecha
     * @since 29/6/2021
     * @author BMOTTAG
	 */
	public function buscar_encuestas()
	{	
			//para identificar en la visda de donde viene
			$data['bandera'] = TRUE;

			$data['fecha'] = $this->input->post('date');
			$arrParam = array(
				'fecha' => $data['fecha']
			);			
			$data['listaEncuestas'] = $this->general_model->get_info_formularios($arrParam);

			$data["view"] ='lista_encuestas_fecha';
			$this->load->view("layout_calendar2", $data);
	}

    /**
     * Cargo modal - formulario buscar reservas por rango de fechas
     * @since 29/6/2021
     */
    public function cargarModalBuscarRango() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
						
			$this->load->view('buscar_rango_modal');
    }
	
	/**
	 * Lista de registrso de encuestas
     * @since 29/6/2021
     * @author BMOTTAG
	 */
	public function buscar_reservas_rango()
	{		
			//para identificar en la vista de donde viene
			$data['bandera'] = FALSE;

			$data['from'] = $this->input->post('from');
			$data['to'] = $this->input->post('to');

			$from = formatear_fecha($data['from']);
			//le sumo un dia al dia final para que ingrese ese dia en la consulta
			$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( formatear_fecha($data['to']) ) ) );

			$arrParam = array(
				'from' => $from,
				'to' => $to
			);
			$data['listaEncuestas'] = $this->general_model->get_info_formularios($arrParam);

			$data["view"] ='lista_encuestas_fecha';
			$this->load->view("layout_calendar2", $data);
	}

	/**
	 * Administrador de la encuesta de percepcion
	 */
	public function admin_percepcion()
	{				
			$arrParam = array(
				'fecha' => date('Y-m-d')
			);			
			$data['listaEncuestas'] = $this->general_model->get_info_enc_percepcion($arrParam);
			$data['noEncuestasHOY'] = $data['listaEncuestas']?count($data['listaEncuestas']):0;

			//calculo numero de visitantes para la semana presente
			if (date('D')=='Mon'){
			     $lunes = date('Y-m-d');
			} else {
			     $lunes = date('Y-m-d', strtotime('last Monday', time()));
			}

			$domingo = strtotime('next Sunday', time());
 			$domingo = date('Y-m-d', $domingo);
 			//le sumo un dia al dia final para que ingrese ese dia en la consulta
			$domingo = date('Y-m-d',strtotime ( '+1 day ' , strtotime ($domingo)));

			$arrParam = array(
				'from' => $lunes,
				'to' => $domingo
			);
			$data['listaEncuestasSEMANA'] = $this->general_model->get_info_enc_percepcion($arrParam);
			$data['noEncuestasSEMANA'] = $data['listaEncuestasSEMANA']?count($data['listaEncuestasSEMANA']):0;

			//calculo numero de visitantes para el MES presente
			$month_start = strtotime('first day of this month', time());
			$month_start = date('Y-m-d', $month_start);
			$month_end = strtotime('last day of this month', time());
			$month_end = date('Y-m-d', $month_end);
 			//le sumo un dia al dia final para que ingrese ese dia en la consulta
			$month_end = date('Y-m-d',strtotime ( '+1 day ' , strtotime ($month_end)));

			$arrParam = array(
				'from' => $month_start,
				'to' => $month_end
			);
			$data['listaEncuestasMES'] = $this->general_model->get_info_enc_percepcion($arrParam);
			$data['noEncuestasMES'] = $data['listaEncuestasMES']?count($data['listaEncuestasMES']):0;

			$data["view"] = "dashboard_percepcion";
			$this->load->view("layout_calendar2", $data);
	}

    /**
     * Cargo modal - formulario buscar encuestas de percepcion por rango de fechas
     * @since 30/11/2021
     */
    public function cargarModalPercepcionBuscarRango() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
						
			$this->load->view('buscar_enc_percepcion_rango_modal.php');
    }
	
	/**
	 * Lista de registrso de encuestas
     * @since 30/11/2021
     * @author BMOTTAG
	 */
	public function buscar_encu_percepcion_rango()
	{		
			//para identificar en la vista de donde viene
			$data['bandera'] = FALSE;

			$data['from'] = $this->input->post('from');
			$data['to'] = $this->input->post('to');

			$from = formatear_fecha($data['from']);
			//le sumo un dia al dia final para que ingrese ese dia en la consulta
			$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( formatear_fecha($data['to']) ) ) );

			$arrParam = array(
				'from' => $from,
				'to' => $to
			);
			$data['listaEncuestas'] = $this->general_model->get_info_enc_percepcion($arrParam);

			$data["view"] ='lista_enc_percepcion_fecha';
			$this->load->view("layout_calendar2", $data);
	}
	
}