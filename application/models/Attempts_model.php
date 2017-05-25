<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attempts_model extends CI_Model{

	public function add_attempt($data){
		$this->db->insert('log_in', $data);
	}
	public function count_attempt($ip_id){
		$time = time() - (10*60);
		$this->db->select('COUNT(username) as attempts');
		$this->db->where('address', $ip_id);
		$this->db->where('time >=', $time);
		$query = $this->db->get('log_in');
		return $query->result();

	}
}