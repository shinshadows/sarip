<?php
    
    class m_pais extends CI_Model {

        function __construct(){
            parent::__construct();
            $this->load->database();// instancia  la conexion a la base de datos
        }
    

        public function login_user($username,$password) {
            $this->db->where('username',$username);
            $this->db->where('password',$password);
            $query = $this->db->get('users');
            if($query->num_rows() == 1)
            {
                return $query->row();
            }else{
                $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
                redirect(base_url().'login','refresh');
            }
        }
        

    }
