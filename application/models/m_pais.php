<?php
    
    class m_pais extends CI_Model {

        function __construct(){
            parent::__construct();
            $this->load->database();// instancia  la conexion a la base de datos
        }
    
        public function countPais( ) {
            return $this->db->count_all("pais");  //funcion que me trae  la cantidad de registros dentro de la tabla pais          
        }

        public function createPais($datos_model) {
            
            
            $datos_model = array(
                'pais' => $this->input->post('pais'),
                'ciudad' => $this->input->post('ciudad'),
                'moneda' => $this->input->post('moneda')
            );
            return $this->db->insert('pais', $datos_model);            
        }

        public function readPais($limit, $start) {
            
            $this->db->limit($limit, $start);
            $query = $this->db->get("pais");
 
            if ($query->num_rows() > 0) 
            {
                foreach ($query->result() as $row) 
                {
                    $data[] = $row;
                }
                 
                return $data;
            }
     
            return false;            
        }

        public function updatePais($datos_model) {
            $datos_model=array(
                'title' => $this->input->post('title'),
                'description'=> $this->input->post('description')
            );
            if($id==0){
                return $this->db->insert('items',$data);
            }else{
                $this->db->where('id',$id);
                return $this->db->update('items',$data);
            }                  
        }
        
        public function deletePais($id) {
            return $this->db->delete('items', array('id' => $id));            
        }
        
        

    }
