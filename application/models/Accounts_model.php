<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_model extends CI_Model{

	public function check_user($data){
		$this->db->select('username, name, user_level');
		$this->db->where($data);
		$query = $this->db->get('users');
		return $query->result();
	}
	
}
?>