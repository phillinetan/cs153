<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogIn extends CI_Controller {


	public function index()
	{
		$this->load->view('login_form');
	}

	public function user_login_process(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE){
			if (isset($this->session->userdata['logged_in'])){
				$this->load->view('welcome_message');
			}else{

			}
		}else{
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
				);
			$result = $this->login_database->login($data);
			if ($result != FALSE){
				$session_data = array(
					'username' => $result[0]->username);
				$this->session->set_userdata('logged_in', $session_data);
				$this->load->view('admin_page');
			}

		}
	}
}