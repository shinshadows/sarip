<?php
defined("BASEPATH") OR die("El acceso al script no está permitido");

class Pdf_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getProvincias()
    {
        $query = $this->db->get('pais');
        // return $query->result();
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
             
            return $data;
        }
    }   
}   