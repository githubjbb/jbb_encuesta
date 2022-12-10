<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Settings_model extends CI_Model {

	    
		/**
		 * Verify if the user already exist by the social insurance number
		 * @author BMOTTAG
		 * @since  8/11/2016
		 * @review 10/12/2020
		 */
		public function verifyUser($arrData) 
		{
				if (array_key_exists("idUser", $arrData)) {
					$this->db->where('id_user !=', $arrData["idUser"]);
				}			

				$this->db->where($arrData["column"], $arrData["value"]);
				$query = $this->db->get("usuarios");

				if ($query->num_rows() >= 1) {
					return true;
				} else{ return false; }
		}
		
		/**
		 * Add/Edit USER
		 * @since 8/11/2016
		 */
		public function saveUser() 
		{
				$idUser = $this->input->post('hddId');
				
				$data = array(
					'first_name' => $this->input->post('firstName'),
					'last_name' => $this->input->post('lastName'),
					'log_user' => $this->input->post('user'),
					'movil' => $this->input->post('movilNumber'),
					'email' => $this->input->post('email'),
					'fk_id_user_role' => $this->input->post('id_role')
				);	

				//revisar si es para adicionar o editar
				if ($idUser == '') {
					$data['status'] = 0;//si es para adicionar se coloca estado inicial como usuario nuevo
					$data['password'] = 'e10adc3949ba59abbe56e057f20f883e';//123456
					$query = $this->db->insert('usuarios', $data);
				} else {
					$data['status'] = $this->input->post('status');
					$this->db->where('id_user', $idUser);
					$query = $this->db->update('usuarios', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
	    /**
	     * Reset user´s password
	     * @author BMOTTAG
	     * @since  11/1/2017
	     */
	    public function resetEmployeePassword($idUser)
		{
				$passwd = '123456';
				$passwd = md5($passwd);
				
				$data = array(
					'password' => $passwd,
					'status' => 0
				);

				$this->db->where('id_user', $idUser);
				$query = $this->db->update('usuarios', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }

	    /**
	     * Update user´s password
	     * @author BMOTTAG
	     * @since  8/11/2016
	     */
	    public function updatePassword()
		{
				$idUser = $this->input->post("hddId");
				$newPassword = $this->input->post("inputPassword");
				$passwd = str_replace(array("<",">","[","]","*","^","-","'","="),"",$newPassword); 
				$passwd = md5($passwd);
				
				$data = array(
					'password' => $passwd
				);

				$this->db->where('id_user', $idUser);
				$query = $this->db->update('usuarios', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }
		
		/**
		 * Edit Proceso
		 * @since 18/5/2021
		 */
		public function saveProceso() 
		{
				$idUser = $this->session->userdata("id");
				$idProcesoInfo = $this->input->post('hddId');
				$titulo =  $this->security->xss_clean($this->input->post('titulo'));
				$titulo =  addslashes($titulo);
				$texto =  $this->security->xss_clean($this->input->post('texto'));
				$texto =  addslashes($texto);
				
				$data = array(
					'fk_id_usuario_pi' =>  $idUser,
					'fecha_registro_informacion' => date("Y-m-d G:i:s"),
					'title' => $titulo,
					'texto' => $texto
				);	
				$this->db->where('id_proceso_informacion', $idProcesoInfo);
				$query = $this->db->update('procesos_informacion', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Add Auditoria Proceso
		 * @since 18/5/2021
		 */
		public function saveAuditoriaProceso() 
		{
				$idUser = $this->session->userdata("id");
				$idProcesoInfo = $this->input->post('hddId');
				$titulo =  $this->security->xss_clean($this->input->post('titulo'));
				$titulo =  addslashes($titulo);
				$texto =  $this->security->xss_clean($this->input->post('texto'));
				$texto =  addslashes($texto);
				
				$data = array(
					'fk_id_proceso_informacion_api' =>  $idProcesoInfo,
					'fk_id_usuario_api' =>  $idUser,
					'fecha_registro_informacion_api' => date("Y-m-d G:i:s"),
					'title_api' => $titulo,
					'texto_api' => $texto
				);	
				$query = $this->db->insert('auditoria_procesos_informacion', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Add/Edit DOCUMENTS
		 * @since 25/5/2021
		 */
		public function saveDocumento($archivo) 
		{
				$idDocumento = $this->input->post('hddidDocumento');
				$idUser = $this->session->userdata("id");
			
				$data = array(
					'fk_id_proceso_informacion' => $this->input->post('hddidProcesosInfo'),
					'fk_id_tema' => $this->input->post('hddidTema'),
					'fk_id_usuario' => $idUser,
					'fecha_registro' => date("Y-m-d G:i:s"),
					'cod' => $this->input->post('codigo'),
					'shortName' => $this->input->post('nombre'),
					'longName' => '',
					'orden' => $this->input->post('orden'),
					'estado' => $this->input->post('estado')
				);

				if($archivo != 'xxx'){
					$data['url'] = $archivo;
				}

				//revisar si es para adicionar o editar
				if ($idDocumento == '') {
					$query = $this->db->insert('procesos_documentos', $data);
					$idDocumento = $this->db->insert_id();			
				}else{
					$this->db->where('id_procesos_documento', $idDocumento);
					$query = $this->db->update('procesos_documentos', $data);
				}
				if ($query) {
					return $idDocumento;
				} else {
					return false;
				}
		}

		/**
		 * Add Auditoria Documentos
		 * @since 18/5/2021
		 */
		public function saveAuditoriaDocumentos($idDocumento, $archivo) 
		{
				$idUser = $this->session->userdata("id");
				$idDocumentoInfo = $this->input->post('hddidDocumento');

				if($idDocumentoInfo == ''){
					if($_FILES['userfile']['name']== ""){
						$observacion = 'Nuevo, no se cargo documento';
					}else{
						$observacion = 'Nuevo, se cargo documento';
					}
				}else{
					if($_FILES['userfile']['name']== ""){
						$observacion = 'Actualización de información, no se actualiza documento';
					}else{
						$observacion = 'Se actualiza documento';
					}
				}

				if($archivo != 'xxx'){
					$url = $archivo;
				}else{
					$url = '';
				}
				
				$data = array(
					'fk_id_proceso_documento' => $idDocumento,
					'fk_id_proceso_informacion' => $this->input->post('hddidProcesosInfo'),
					'fk_id_tema' => $this->input->post('hddidTema'),
					'fk_id_usuario' => $idUser,
					'fecha_registro' => date("Y-m-d G:i:s"),
					'cod' => $this->input->post('codigo'),
					'url' => $url,
					'shortName' => $this->input->post('nombre'),
					'longName' => '',
					'orden' => $this->input->post('orden'),
					'estado' => $this->input->post('estado'),
					'observacion' => $observacion
				);	
				$query = $this->db->insert('auditoria_documentos', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		
	    
	}