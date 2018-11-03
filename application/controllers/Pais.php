<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pais extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_pais'); //instancio el modelo de pais para tenerlo listo para una consulta
		$this->load->helper('ayudante');//instancio un archivo de ayudante para formularios
		$this->load->helper('url');	
		$this->load->library('form_validation');//libreria para validar formularios
		$this->load->library('pagination');//instancio la libreria de paginación
		$this->load->library('mybreadcrumb');// instancio la libreria de los Breadcrumbs 
		$this->load->library('email');// instancio la libreria de correos

		// $this->load->helper('pais/form_helper');
	}

	public function index(){// controlador principal del a clase
			
		// aqui le paso los enlaces para los breadcrumbs que seran llamados en la vista
		$this->mybreadcrumb->add('Home', base_url());
		$this->mybreadcrumb->add('Paises', base_url('/pais/index'));
		$this->mybreadcrumb->add(' ', base_url(' '));
		$data['breadcrumbs'] = $this->mybreadcrumb->render();// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla

		$limit_per_page ='10';//limite de registros que quiero por pagina
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //retiene el índice de inicio del registro MySQL
		
		$config['base_url'] = base_url()."pais/pagina/";
		$config['total_rows'] = $this->m_pais->countPais();//obtengo el numero de registros y lo paso para el numero de filas en la paginacion
		$config['per_page'] = 	$limit_per_page; //Número de registros mostrados por páginas		
		$config['uri_segment'] = '3';//el segmento del slug donde se obtiene el numero de pagina
		 	
		$config['num_links'] = '5';//cantidad de enlaces que quiero en la paginacion
		
	 

		//se le agrega las clases de bootstrap a la paginacion
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['attributes'] = array('class'=>'page-link');
		
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li class="page-item  ">';
		$config['first_tagl_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tagl_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>  ';
		// $config['cur_tag_close'] = '</a></li>';

		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tagl_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tagl_close'] = '</li>';
	
	
	 
		$config['next_link'] = '&laquo';
		$config['prev_link'] = '&laquo';


		//se le agrega las clases de bootstrap a la paginacion
		$config['use_page_numbers'] = TRUE;
		$config['use_page_numbers'] = TRUE;


		 
		
		
		
		 
		
		$data['paginacion'] 	= $this->pagination->create_links();//se pasa por parametros el codigo para que genere la paginacion en la vista
		
		if ($this->m_pais->paginationPais($limit_per_page, $start_index) == false){
			
			$this->session->set_flashdata('danger', ' No se encontraron registros de paises en la base de datos, si desea realizar un registro presione el boton Registrar pais');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
			
			 
			$data['content'] = "pais/alerta"; //se pasa laa vista para ser mostrada dentro del template
			$this->load->view("plantilla",$data);//se carga el template principal y dentro de el se pasan parametros como template del modulo y parametros a mostrar			
			
		}else{
			

			$this->pagination->initialize($config);//inicializo la libreria del a paginacion
			$data['cant_pais'] 		= $this->m_pais->countPais(); //se pasa el numero de registros de la tabla para mostar el total d registros
			$data['paises'] 		= $this->m_pais->paginationPais($limit_per_page, $start_index);  // instancio el modelo y obtengo los datos de la consulta con un rango registros de acuerdo a la  paginación

			$data['content'] 		= "pais/index"; //se pasa laa vista para ser mostrada dentro del template
			$this->load->view("plantilla",$data);//se carga el template principal y dentro de el se pasan parametros como template del modulo y parametros a mostrar			
		}
		
	}
	
	public function nuevoPais(){ //Metodo que muestra la pagina y formulario de registro para pais		
		// aqui le paso los enlaces para los breadcrumbs que seran llamados en la vista
		$this->mybreadcrumb->add('Home', base_url());
		$this->mybreadcrumb->add('Paises', base_url('pais/index'));
		$this->mybreadcrumb->add('Agregar Nuevo', base_url('pais/nuevoPais'));
		$this->mybreadcrumb->add(' ', base_url(' '));

 
	 
		$data['breadcrumbs'] = $this->mybreadcrumb->render();// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla
		
		$data['content'] = "pais/reg_pais";//se pasa laa vista para ser mostrada dentro del template
		$this->load->view("plantilla",$data);//se carga el template principal y dentro de el se pasan parametros como template del modulo y parametros a mostrar			
	}

	public function recibirDatos(){//en este metodo recibo los datos del formulario para registrarlo en la BD
	
		// aqui le paso los enlaces para los breadcrumbs que seran llamados en la vista
		$this->mybreadcrumb->add('Home', base_url());
		$this->mybreadcrumb->add('Paises', base_url('/pais/alerta'));
		$this->mybreadcrumb->add(' ', base_url(' '));
			
 
		 
		$data['breadcrumbs'] 	= $this->mybreadcrumb->render();/// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla
		

		if ($this->input->post())	{
			
			$this->form_validation->set_rules('pais', 'Pais', 'required'); //se realiza una validación de los campos de manera que no sean modificados externamente quitando los atributos
			$this->form_validation->set_rules('ciudad', 'Ciudad','required');//se realiza una validación de los campos de manera que no sean modificados externamente quitando los atributos
			$this->form_validation->set_rules('moneda', 'Moneda','required');//se realiza una validación de los campos de manera que no sean modificados externamente quitando los atributos
 
		
			if ($this->form_validation->run() == True){	// se valida que los atributos pasaron la validación
				
				// se crea un diccionario "$datos_controller" y se le pasan los datos del formularios POST
				$datos_controller['pais']= $_POST['pais'];
				$datos_controller['ciudad']= $_POST['ciudad'];
				$datos_controller['moneda']= $_POST['moneda'];

				if ($this->m_pais->createPais($datos_controller)==true){// se instancia el modelo y la funcion "createPais", se le pasan los datos recogidos por post desde un diccionario"$datos_controller"
					$this->session->set_flashdata('success', ' El registro se realizó exitosamente ');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
		 			header('Refresh:0.1; url= '. base_url().'pais'); 	//se redirecciona luego de 3 segundos				
				}else{
					$this->session->set_flashdata('danger',$error);//message rendered
					header('Refresh:0.1; url= '. base_url().'/pais'); //se redirecciona luego de 3 segundos			 
				}
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

	public function editarPais(){
		
		$this->mybreadcrumb->add('Home', base_url());
		$this->mybreadcrumb->add('Paises', base_url('pais/index'));
		$this->mybreadcrumb->add('Editar Pais', base_url('pais/editarPais'));
		$this->mybreadcrumb->add(' ', base_url(' '));
		$data['breadcrumbs'] = $this->mybreadcrumb->render();// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla

		if ($data['segmento']= $this->uri->segment(3)){ //se valida si se recibe el id del registro a modificar en el segmento 3 del url

			if ($this->m_pais->showPaisbyId($data['segmento'])==True){ //si la consulta se realiza por id correctamente se pasa la data a la plantilla por parametro
				$data['pais'] = $this->m_pais->showPaisbyId($data['segmento']);
				$data['content'] = "pais/edit_pais";//se pasa laa vista para ser mostrada dentro del template
				$this->load->view("plantilla",$data);//se carga el template principal y dentro de el se pasan parametros como template del modulo y parametros a mostrar			
			}else{ //si no se recibieron datos se muesta error y se redirige 
				$this->session->set_flashdata('danger', ' No se recibieron datos de la consulta, intente nuevamente');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
				header('Refresh:0.1; url= '. base_url().'pais'); 	//se redirecciona luego de 3 segundos
			}
		
		}else{ // si no hay id a modificar se redirecciona y se muestra una ventana
			$this->session->set_flashdata('danger', ' No serecibió el id del registro a modificar, intente nuevamente');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
			header('Refresh:0.1; url= '. base_url().'pais'); 	//se redirecciona luego de 3 segundos
		}

	}
	
	public function actualizarPais( ){
		 
		$this->mybreadcrumb->add(' ', base_url(' '));
		$data['breadcrumbs'] = $this->mybreadcrumb->render();// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla

		if ($this->input->post())	{
			// se crea un diccionario "$datos_controller" y se le pasan los datos del formularios POST
			$datos_controller['id']= $this->uri->segment(3); 
			$datos_controller['pais']= $_POST['pais'];
			$datos_controller['ciudad']= $_POST['ciudad'];
			$datos_controller['moneda']= $_POST['moneda'];

			if ($this->m_pais->updatePais($datos_controller)){//se valida si se realiza la actualizacion del registro
				$this->session->set_flashdata('success', ' la actualizacion del registro se realizó exitosamente ');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
				header('Refresh:0.1; url= '. base_url().'pais/index'); 	//se redirecciona luego de 3 segundos				
			}else{
				$this->session->set_flashdata('danger', 'Fallo la actualizacion del registro ');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
				header('Refresh:0.1; url= '. base_url().'pais/index'); 	//se redirecciona luego de 3 segundos				
			}
		}else{
			$this->session->set_flashdata('danger', 'No se reciben datos del formulario');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
			header('Refresh:0.1; url= '. base_url().'pais/index'); 	//se redirecciona luego de 3 segundos				
		}
		 

	}
	
	public function borrarPais($id){

		$this->mybreadcrumb->add(' ', base_url(' '));
		$data['breadcrumbs'] = $this->mybreadcrumb->render();// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla
		
		//segmentacion para traerme el id por get
		$data['segmento']= $this->uri->segment(3);		 
		$id= $this->uri->segment(3);
		if (isset($id))	{
			if ($this->m_pais->deletePais($id)==True){ //si la consulta se realiza correctamente se pasa la data a la plantilla por parametro
				$this->session->set_flashdata('success',  ' Se elimino el  exitosamente ');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
				header('Refresh:0.1; url= '. base_url().'pais'); 	//se redirecciona luego de 3 segundos				
			}else{ //si no se recibieron datos se muesta error y se redirige 
				$this->session->set_flashdata('danger', ' No se elimino el registro, error:sadsa ');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
				header('Refresh:0.1; url= '. base_url().'pais'); 	//se redirecciona luego de 3 segundos
			}
		}else{
			$this->session->set_flashdata('danger', ' No se recibio el id del registro a  eliminar ');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
			header('Refresh:0.1ww; url= '. base_url().'pais'); 	//se redirecciona luego de 3 segundos
		}
	}

	public function email($id){

		$this->mybreadcrumb->add(' ', base_url(' '));
		$data['breadcrumbs'] = $this->mybreadcrumb->render();// se pasan el breadcrumbs a la vista como parametros para luego ser mostrados en la plantilla
		
		//segmentacion para traerme el id por get
		$data['segmento']= $this->uri->segment(3);		 
		$id= $this->uri->segment(3);
		if (isset($id))	{
			if ($this->m_pais->deletePais($id)==True){ //si la consulta se realiza correctamente se pasa la data a la plantilla por parametro
				$this->session->set_flashdata('success',  ' Se elimino el  exitosamente ');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
				header('Refresh:0.1; url= '. base_url().'pais'); 	//se redirecciona luego de 3 segundos				
			}else{ //si no se recibieron datos se muesta error y se redirige 
				$this->session->set_flashdata('danger', ' No se elimino el registro, error:sadsa ');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
				header('Refresh:0.1; url= '. base_url().'pais'); 	//se redirecciona luego de 3 segundos
			}
		}else{
			$this->session->set_flashdata('danger', ' No se recibio el id del registro a  eliminar ');//se utiliza el metodo set flashdata para pasar un mensaje por coockie de session teemporal
			header('Refresh:0.1ww; url= '. base_url().'pais'); 	//se redirecciona luego de 3 segundos
		}
	}


}
