<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
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
    
    public function set_users($id){
        $this->load->helper('url');
 
        $data = array(
            'id' => $this->input->post('id'),
            'username' => $this->input->post('username'),
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'birthday' => $this->input->post('birthday'),
            'password' => md5($this->input->post('password')),
            'user_level' => '2'
        );
        
        if ($id == 0) {
            return $this->db->insert('users', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        }
    }
    
    public function delete_users($id){
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
}
?>