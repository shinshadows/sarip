<?php
    
    class m_pais extends CI_Model {

        function __construct(){
       
            parent::__construct();
            $this->load->database();// instancia  la conexion a la base de datos
        }
    
        public function countPais( ) {
            return $this->db->count_all("pais");  //funcion que me trae  la cantidad de registros dentro de la tabla pais          
        }

        public function paginationPais($limit, $start) {
            $this->db->limit($limit, $start);
            $query = $this->db->get("pais");
            if ($query->num_rows() > 0) 
            {
                foreach ($query->result() as $row) 
                {
                    $data[] = $row;
                }
                 
                return $data;
            }else{
                return false;
            }
     
        }

        public function createPais($datos_model) {// funcion para registrar los paises
                  
            $datos_model = array( //creo un array de los parametros que se pasan por post desde del controlador
                'pais' => $this->input->post('pais'),
                'ciudad' => $this->input->post('ciudad'),
                'moneda' => $this->input->post('moneda')
            );
            if ($this->db->insert('pais', $datos_model)){// se hace la consulta tipo CDIGNITR,  Se valida si se realiza y se retorna verdadero o falso
  				return true;
			}else{
 				return false;
            }	
        }

        
        public function showPaisbyId($id) {
            
            
            $this->db->where('id', $id);
            if ($query = $this->db->get("pais")){
                return $query->result();
            }else{
                return false;
            }
           

        }


        public function updatePais($datos_model) {

            $datos_model=array(//se crea un array para recibir y contener los datos del controlador
                'id' => $datos_model['id'],
                'pais' => $this->input->post('pais'),
                'ciudad'=> $this->input->post('ciudad'),
                'moneda'=> $this->input->post('moneda')
            );
            if($datos_model['id'] == null ){
                return false;
            }else{
                $this->db->where('id', $datos_model['id']);
                if ($this->db->update('pais',$datos_model)){
                    return true;
                }else{
                    return false;
                }


            }                  
        }
        
        public function deletePais($id) {
   
        
			$resultado = $this->db->delete('pais',array('id'=> $id));
			if(count($resultado) > 0) {
				return true;
			}else{
				return false;
			}
        
            // dentro del condicional se introduce el query de tipo INSERT, 
            // como parametro se pasa el nombre de la tabla y luego el array
            
             
            
          
         
        }
        
        

    }
