<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_model extends CI_Model{

	public function check_user($data){
		$this->db->select('username, name, user_level');
		$this->db->where($data);
		$query = $this->db->get('users');
		return $query->result();
	}
	public function view_all(){
		$query = $this->db->select('name, birthday')->get_compiled_select();
		return $query->result();
	}

	public function check_authorization($data){
		$this->db->select('authority');
		$this->db->where($data);
		$query = $this->db->get('users');
		return $query->result();
	}
}
?>