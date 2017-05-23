<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model{
	public function check_user($data){
		$query = $this->db->get_where('users', array('username' =>$data['username'], 'password' => $data['password']));
		return $query->result();
	}
	public function view_all(){
		$query = $this->db->select('name', 'birthday')->get_compiled_select();
		return $query->result();
	}
}
?>