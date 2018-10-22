<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pais extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_pais'); //instancio el modelo de pais para tenerlo listo para una consulta
		$this->load->helper('ayudante');//instancio un archivo de ayudante para formularios

		$this->load->library('form_validation');//libreria para validar formularios
		$this->load->library('pagination');//instancio la libreria de paginación
		$this->load->library('mybreadcrumb');// instancio la libreria de los Breadcrumbs 
		

		// $this->load->helper('pais/form_helper');
	}

	public function index(){// controlador principal del a clase
		
		$this->load->helper('url');	
		$this->load->library('pagination');//libreria para la paginacion
		$limit_per_page ='3';
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //retiene el índice de inicio del registro MySQL
		

		$config['base_url'] = base_url()."pais/pagina/";
		$config['total_rows'] = $this->m_pais->countPais();//obtengo el numero de registros y lo paso para el numero de filas en la paginacion
		$config['per_page'] = 	$limit_per_page; //Número de registros mostrados por páginas		
		$config['uri_segment'] = '3';//el segmento del slug donde se obtiene el numero de pagina
		 	
		$config['num_links'] = '5';//cantidad de enlaces que quiero en la paginacion
		
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;

		//se le agrega las clases de bootstrap a la paginacion
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tagl_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tagl_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item disabled">';
		$config['first_tagl_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tagl_close'] = '</a></li>';
		$config['attributes'] = array('class' => 'page-link');
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		//se le agrega las clases de bootstrap a la paginacion
		$config['use_page_numbers'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);//inicializo la libreria del a paginacion
		 

		
		
		// aqui le paso los enlaces para los breadcrumbs que seran llamados en la vista
		$this->mybreadcrumb->add('Home', base_url());
		$this->mybreadcrumb->add('Paises', base_url('/pais/index'));
		$this->mybreadcrumb->add(' ', base_url(' '));

		
		$data['breadcrumbs'] 	= $this->mybreadcrumb->render();// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla
		$data['paginacion'] 	= $this->pagination->create_links();//se pasa por parametros el codigo para que genere la paginacion en la vista
		$data['cant_pais'] 		= $this->m_pais->countPais(); //se pasa el numero de registros de la tabla para mostar el total d registros
		$data['alerta'] 		= "No se consiguen registros en la base de datos.";
		$data['paises'] 		= $this->m_pais->readPais($limit_per_page, $start_index);  // instancio el modelo y obtengo los datos de la consulta con un rango registros de acuerdo a la  paginación
		$data['content'] 		= "pais/index"; //se pasa laa vista para ser mostrada dentro del template
		$this->load->view("plantilla",$data);//se carga el template principal y dentro de el se pasan parametros como template del modulo y parametros a mostrar			
	}
	
	public function nuevoPais(){ //Metodo que muestra la pagina y formulario de registro para pais		
		// aqui le paso los enlaces para los breadcrumbs que seran llamados en la vista
		$this->mybreadcrumb->add('Home', base_url());
		$this->mybreadcrumb->add('Paises', base_url('pais/index'));
		$this->mybreadcrumb->add('Agregar Nuevo', base_url('pais/nuevoPais'));
		$this->mybreadcrumb->add(' ', base_url(' '));

		
		$data['ayuda'] = main_menu();// se pasan el helper a la vista como parametros para luego ser mostrados en la plantilla
		$data['breadcrumbs'] = $this->mybreadcrumb->render();// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla
		
		$data['content'] = "pais/reg_pais";//se pasa laa vista para ser mostrada dentro del template
		$this->load->view("plantilla",$data);//se carga el template principal y dentro de el se pasan parametros como template del modulo y parametros a mostrar			
	}

	public function recibirDatos(){//en este metodo recibo los datos del formulario para registrarlo en la BD
		

		if ($this->input->post())	{
			
			$this->form_validation->set_rules('pais', 'Pais', 'required'); //se realiza una validación de los campos de manera que no sean modificados externamente quitando los atributos
			$this->form_validation->set_rules('ciudad', 'Ciudad','required');//se realiza una validación de los campos de manera que no sean modificados externamente quitando los atributos
			$this->form_validation->set_rules('moneda', 'Moneda','required');//se realiza una validación de los campos de manera que no sean modificados externamente quitando los atributos
 
		
			if ($this->form_validation->run() == True){	// se valida que los atributos pasaron la validación
				
				// se crea un diccionario "$datos_controller" y se le pasan los datos del formularios POST
				$datos_controller['pais']= $_POST['pais'];
				$datos_controller['ciudad']= $_POST['ciudad'];
				$datos_controller['moneda']= $_POST['moneda'];

				$this->m_pais->createPais($datos_controller);// se instancia el modelo y la funcion "createPais", se le pasan los datos recogidos por post desde un diccionario"$datos_controller"
			}else{
				$data['mensaje'] = "No se recibieron los datos correctamente, intente de nuevo";
				$data['content'] = "pais/reg_pais";
				$this->load->view("plantilla",$data);
			}
		}else{
			$data['content'] = "pais/reg_pais";
			$this->load->view("plantilla",$data);
		}
		 
	}

	public function editarPais($id){
		$this->mybreadcrumb->add('Home', base_url());
		$this->mybreadcrumb->add('Paises', base_url('pais/index'));
		$this->mybreadcrumb->add('Editar Pais', base_url('pais/editarPais'));
		$this->mybreadcrumb->add(' ', base_url(' '));
		$data['breadcrumbs'] = $this->mybreadcrumb->render();// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla

		if ($data['segmento']= $this->uri->segment(3)){
			$data['pais'] = $this->m_pais->getPais($data['segmento']); 
			$data['content'] = "pais/edit_pais";//se pasa laa vista para ser mostrada dentro del template
			$this->load->view("plantilla",$data);//se carga el template principal y dentro de el se pasan parametros como template del modulo y parametros a mostrar			
		}else{
			$mensaje= "no se recibio el id del pais";
			echo $mensaje;
		}

	}
	
	public function actualizarPais( ){

		$this->mybreadcrumb->add(' ', base_url(' '));
		$data['breadcrumbs'] = $this->mybreadcrumb->render();// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla

		if ($this->input->post())	{
			// se crea un diccionario "$datos_controller" y se le pasan los datos del formularios POST
			$datos_controller['id']= $_POST['id'];
			$datos_controller['pais']= $_POST['pais'];
			$datos_controller['ciudad']= $_POST['ciudad'];
			$datos_controller['moneda']= $_POST['moneda'];

			 

			if ($this->m_pais->updatePais($datos_controller)){
				exit;
				$data['alerta'] = "Datos actualizados correctamente";
				$data['content'] = "pais/index"; //se pasa laa vista para ser mostrada dentro del template
				$this->load->view("plantilla",$data);//se carga el template principal y dentro de el se pasan parametros como template del modulo y parametros a mostrar			
			}else{
				echo "fallido";
			}
		}else{
			// $data['content'] = "pais/reg_pais";
			// $this->load->view("plantilla",$data);
			echo "no se reciben los post";
		}
		 

	}
	
	public function borrarPais($id){
		
		//segmentacion para traerme el id por get
		$data['segmento']= $this->uri->segment(3);		 
		$id= $this->uri->segment(3);
		if ($id)	{
			$data['paises'] = $this->m_pais->deletePais($id);
			// $data['content'] = "pais/reg_pais";
			// $this->load->view("plantilla",$data);
			 
		 
		}
	}


}
