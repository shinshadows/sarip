<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		// $this->load->model('m_login'); //instancio el modelo de pais para tenerlo listo para una consulta
		 







		// $this->load->library('form_validation');//libreria para validar formularios
		$this->load->library('mybreadcrumb');// instancio la libreria de los Breadcrumbs 
		

		// $this->load->library(array('session','form_validation'));
		// $this->load->helper(array('url','form'));


		// $this->load->helper('pais/form_helper');
	}

	public function index(){// controlador principal del a clase
		
		$this->load->helper('url');	
		 
		 
		// aqui le paso los enlaces para los breadcrumbs que seran llamados en la vista
		$this->mybreadcrumb->add('Home', base_url());
		$this->mybreadcrumb->add('Login', base_url('/login'));
		$this->mybreadcrumb->add(' ', base_url(' '));

		
		switch ($this->session->userdata('perfil')) {
			case '':
				$data['token'] = $this->token();
				$data['titulo'] = 'Login con roles de usuario en codeigniter';
				$data['breadcrumbs'] 	= $this->mybreadcrumb->render();// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla
				$data['content'] 		= "login/login_view"; //se pasa laa vista para ser mostrada dentro del template
				$this->load->view("plantilla",$data);//se carga el template principal y dentro de el se pasan parametros como template del modulo y parametros a mostrar			
				break;
			case 'administrador':
				redirect(base_url().'admin');
				break;
			case 'editor':
				redirect(base_url().'editor');
				break; 
			case 'suscriptor':
				redirect(base_url().'suscriptor');
				break;
			default: 
				$data['titulo'] = 'Login con roles de usuario en codeigniter';
				$data['breadcrumbs'] 	= $this->mybreadcrumb->render();// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla
				$data['content'] 		= "login/index"; //se pasa laa vista para ser mostrada dentro del template
				$this->load->view("plantilla",$data);//se carga el template principal y dentro de el se pasan parametros como template del modulo y parametros a mostrar			
				break; 
		}
	
	}
	 

	public function new_user() {
		if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')){
			$this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
			$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[5]|max_length[150]|xss_clean');

			//lanzamos mensajes de error si es que los hay

			if($this->form_validation->run() == FALSE) {
				$this->index();
			}else{
				$username = $this->input->post('username');
				$password = sha1($this->input->post('password'));
				$check_user = $this->login_model->login_user($username,$password);
				if($check_user == TRUE)	{	
					$data = array(
					'is_logued_in' => TRUE,
					'id_usuario' => $check_user->id,
					'perfil' => $check_user->perfil,
					'username' => $check_user->username
					); 
					$this->session->set_userdata($data);
					$this->index();
				}
			}

		}else{
				redirect(base_url().'login');
		}
	}

	public function token() {
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}

	public function logout_ci() {
		$this->session->sess_destroy();
		$this->index();
	}

}
