<?php if ( ! ('BASEPATH')) exit('No direct script access allowed'); 

class Login extends CI_Controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		
		//comprobamos si el usuario está logueado
		if($this->auth->is_logged() == TRUE)
		{
			
			redirect(base_url('home'));
			
		}
			
	}
	
	//cargamos la vista del login con sus datos
	public function index()
	{
		
		$data = array('titulo' => 'Creando nuestras propias librerías en codeigniter',
					  'campos' => $this->auth->campos_formulario(),
					  'token'  => $this->auth->token()       
				      );
					  
		$this->load->view('login',$data);
		
	}
	
	//cargamos la vista del registro con sus datos
	public function registro()
	{
		
		$data = array('titulo' => 'Creando nuestras propias librerías en codeigniter',
					  'campos' => $this->auth->campos_formulario(),
					  'token'  => $this->auth->token(),
					  'key'	   => 'clave pública recaptcha'	              
				      );
					  
		$this->load->view('registro',$data);

	}

	//creamos la lógica para loguear a nuestros usuarios
	public function user_login()
	{
		
		//si hacen submit al formulario	
		if($this->input->post('submit'))
		{			
			
			//prevenimos ataques Cross-Site Request Forgery (CSRF)
			if($this->input->post('token') == $this->session->userdata('token'))
			{
				//si la validación del formulario falla
				//devolvemos al index mostrando los errores
				if($this->auth->validate() == FALSE)
				{
					
					$this->index();
					
				}else{				
					
					$email = $this->input->post('email');
					$password = $this->input->post('password');
					
					//si falla la autentificación creamos una sesión flashdata
					//para mostrar un mensaje y redirigimos con refresh
					//al login de nuevo
					if($this->auth->login_user($email,$password) == FALSE){
					
						$this->session->set_flashdata('noexiste','El usuario ingresado no existe');
						redirect(base_url('login','refresh'));				
					
					}else{
						
						//si el login es correcto creamos las sesiones
						//con la función crear_sesiones y redirigimos
						//a la home
						$this->auth->crear_sesiones($email,$password);
						redirect(base_url('home','refresh'));
						
					}
					
				} 
			
			}

		}else{
			
			redirect(base_url('login'));
			
		}
			
	}     
	
	//función para verificar si el captcha es correcto
	public function verifica_captcha()
	{
            //aquí debemos la clave privada que recaptcha nos ha dado
		$privatekey = "clave privada recaptcha";
		$resp = recaptcha_check_answer ($privatekey,
		                                $_SERVER["REMOTE_ADDR"],
		                                $this->input->post("recaptcha_challenge_field"),
		                                $this->input->post("recaptcha_response_field"));
		
		  if (!$resp->is_valid) {
		    //si el captcha introducido es incorrecto se lo decimos
		    $this->form_validation->set_message('verifica_captcha','El campo es incorrecto');
				 return FALSE;
		  } 
	}
	
	//creamos la lógica para registrar a los usuarios nuevos
	public function registro_nuevo()
	{
		
		if($this->input->post('submit_registro'))
		{
			//prevenimos ataques Cross-Site Request Forgery (CSRF)
			if($this->input->post('token') == $this->session->userdata('token'))
			{
			
				if($this->auth->validate() == FALSE)
				{
					
					$this->registro();
					
				}else{
					
					$email = $this->input->post('email');
					$password = $this->input->post('password');				
					
					if($this->auth->register($email,$password) == TRUE){
					
						$this->session->set_flashdata('existe','El email ingresado ya existe');
						redirect(base_url('login/registro','refresh'));				
					
					}else{
						
						$this->auth->send_mail($email,$password);
						redirect(base_url('home','refresh'));
						
					}
					
				} 
				
			}
			
		}else{
			
			redirect(base_url('login/registro'));
			
		}
		
	}                                      	
	
}
/*
 * end controllers/login.php
 */