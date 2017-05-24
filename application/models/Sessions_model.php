<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions_model extends CI_Model{

	public function update_session($data){
		$this->db->where('username', $data);
		$this->db->select('username');
		$query = $this->db->get('running_session');
		$this->db->set('session_id', session_id());
		if ($query->result() == []){
			$this->db->set('username', $data);
			$this->db->insert('running_session');
		}else{
			$this->db->where('username', $data);
			$this->db->update('running_session');

		}
	}

	public function online_users(){
		$this->db->select('username');
		$this->db->from('running_session');
		$this->db->join('session_table', 'session_id = id');
		$time = time() - (5*60);
		$this->db->where('session_table.timestamp >=', $time);
		$query = $this->db->get();
		return $query->result();

	}
			
}
?>