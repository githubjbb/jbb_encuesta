<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("settings_model");
        $this->load->model("general_model");
		$this->load->helper('form');
    }
	
	/**
	 * Users List
     * @since 15/12/2016
     * @author BMOTTAG
	 */
	public function users($status=1)
	{			
			$data['status'] = $status;
			if($status == 1){
				$arrParam = array("filtroStatus" => TRUE);
			}else{
				$arrParam = array("status" => $status);
			}
			
			$data['info'] = $this->general_model->get_user($arrParam);
			
			$data["view"] = 'users';
			$this->load->view("layout_calendar2", $data);
	}
	
    /**
     * Cargo modal - formulario usuarios
     * @since 15/12/2016
     */
    public function cargarModalUsers() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idUser"] = $this->input->post("idUser");	
			
			$arrParam = array("filtro" => TRUE);
			$data['roles'] = $this->general_model->get_roles($arrParam);

			if ($data["idUser"] != 'x') {
				$arrParam = array("idUser" => $data["idUser"]);
				$data['information'] = $this->general_model->get_user($arrParam);
			}
			
			$this->load->view("users_modal", $data);
    }
	
	/**
	 * Update User
     * @since 15/12/2016
     * @author BMOTTAG
	 */
	public function save_user()
	{			
			header('Content-Type: application/json');
			$data = array();
			$idUser = $this->input->post('hddId');
			$msj = "Se adicionó un nuevo Usuario!";
			if ($idUser != '') {
				$msj = "Se actualizó el Usuario!";
			}
			$log_user = $this->input->post('user');
			$email_user = $this->input->post('email');
			$result_user = false;
			$result_email = false;
			$result_ldap = false;
			//verificar si ya existe el usuario
			$arrParam = array(
				"idUser" => $idUser,
				"column" => "log_user",
				"value" => $log_user
			);
			$result_user = $this->settings_model->verifyUser($arrParam);
			//verificar si ya existe el correo
			$arrParam = array(
				"idUser" => $idUser,
				"column" => "email",
				"value" => $email_user
			);
			$result_email = $this->settings_model->verifyUser($arrParam);
			$data["status"] = $this->input->post('status');
			if ($idUser == '') {
				$data["status"] = 1;//para el direccionamiento del JS, cuando es usuario nuevo no se envia status

				$ldapuser = $this->session->userdata('logUser');
				$ldappass = ldap_escape($this->session->userdata('password'), null, LDAP_ESCAPE_FILTER);
				$ds = ldap_connect("192.168.0.44", "389") or die("No es posible conectar con el directorio activo.");  // Servidor LDAP!
		        if (!$ds) {
		            echo "<br /><h4>Servidor LDAP no disponible</h4>";
		            @ldap_close($ds);
		        } else {
		            $ldapdominio = "jardin";
		            $ldapusercn = $ldapdominio . "\\" . $ldapuser;
		            $binddn = "dc=jardin, dc=local";
		            ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
            		ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
		            $r = @ldap_bind($ds, $ldapusercn, $ldappass);
		            if (!$r) {
		                @ldap_close($ds);
		                $data["msj"] = "Error de autenticación. Por favor revisar usuario y contraseña de red.";
		                $this->session->sess_destroy();
						$this->load->view('login', $data);
		            } else {
		            	$filter = "(&(sAMAccountName=" . $log_user . ")(mail=" . $email_user . "))";
		            	$attributes = array('sAMAccountName', 'mail');
		            	$result = @ldap_search($ds, $binddn, $filter, $attributes);
		            	if (@ldap_count_entries($ds, $result) == 1) {
		            		$result_ldap = false;
		            	} else {
		            		$result_ldap = true;
		            	}
		            }
		        }

			}

			if ($result_user || $result_email || $result_ldap)
			{
				$data["result"] = "error";
				if($result_user)
				{
					$data["mensaje"] = " Error. El Usuario ya existe.";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> El Usuario ya existe.');
				}
				if($result_email)
				{
					$data["mensaje"] = " Error. El correo ya existe.";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> El correo ya existe.');
				}
				if($result_user && $result_email)
				{
					$data["mensaje"] = " Error. El Usuario y el Correo ya existen.";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> El Usuario y el Correo ya existen.');
				}

				if ($result_ldap) {
					$data["mensaje"] = " Error. El usuario no existe en el directorio activo.";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> El usuario no esta creado en el directorio activo.');
				}

			} else {
					if ($this->settings_model->saveUser()) {
						$data["result"] = true;					
						$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> ' . $msj);
					} else {
						$data["result"] = "error";					
						$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
					}
			}
			echo json_encode($data);
    }
	
	/**
	 * Reset employee password
	 * Reset the password to '123456'
	 * And change the status to '0' to changue de password 
     * @since 11/1/2017
     * @author BMOTTAG
	 */
	public function resetPassword($idUser)
	{
			if ($this->settings_model->resetEmployeePassword($idUser)) {
				$this->session->set_flashdata('retornoExito', '<strong>Correcto!</strong> You have reset the Employee pasword to: 123456');
			} else {
				$this->session->set_flashdata('retornoError', '<strong>Error!</strong> Ask for help');
			}
			
			redirect("/settings/employee/",'refresh');
	}	

	/**
	 * Change password
     * @since 15/4/2017
     * @author BMOTTAG
	 */
	public function change_password($idUser)
	{
			if (empty($idUser)) {
				show_error('ERROR!!! - You are in the wrong place. The ID USER is missing.');
			}
			
			$arrParam = array(
				"table" => "usuarios",
				"order" => "id_user",
				"column" => "id_user",
				"id" => $idUser
			);
			$data['information'] = $this->general_model->get_basic_search($arrParam);
		
			$data["view"] = "form_password";
			$this->load->view("layout", $data);
	}
	
	/**
	 * Update user´s password
	 */
	public function update_password()
	{
			$data = array();			
			
			$newPassword = $this->input->post("inputPassword");
			$confirm = $this->input->post("inputConfirm");
			$userState = $this->input->post("hddState");
			
			//Para redireccionar el usuario
			if($userState!=2){
				$userState = 1;
			}
			
			$passwd = str_replace(array("<",">","[","]","*","^","-","'","="),"",$newPassword); 
			
			$data['linkBack'] = "settings/users/" . $userState;
			$data['titulo'] = "<i class='fa fa-unlock fa-fw'></i>CAMBIAR CONTRASEÑA";
			
			if($newPassword == $confirm)
			{					
					if ($this->settings_model->updatePassword()) {
						$data['msj'] = 'Se actualizó la contrasela del usuario.';
						$data['msj'] .= '<br>';
						$data['msj'] .= '<br><strong>Nombre Usuario: </strong>' . $this->input->post('hddUser');
						$data['msj'] .= '<br><strong>Contraseña: </strong>' . $passwd;
						$data['clase'] = 'alert-success';
					}else{
						$data['msj'] = '<strong>Error!!!</strong> Ask for help.';
						$data['clase'] = 'alert-danger';
					}
			}else{
				//definir mensaje de error
				echo "pailas no son iguales";
			}
						
			$data['view'] = "template/answer";
			$this->load->view("layout", $data);
	}
	
	
}