<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Model{

	public function update_session($data){
			$this->db->insert('sessions', $data);
		}
}
?>