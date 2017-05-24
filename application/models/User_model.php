<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {
 
    public function __construct(){
        $this->load->database();
    }
    
    public function get_users($id){
        if ($id === FALSE){
            $query = $this->db->get('users');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }
    
    public function get_users_by_id($id){
        if ($id === 0){
            $query = $this->db->get('users');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }
}