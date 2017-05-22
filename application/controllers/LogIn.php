<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogIn extends CI_Controller {


	public function index()
	{
		$this->load->view('login_form');
	}

	public function user_login_process(){
		/*form_validation(field_name, human_name for error, rules)*/
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|alpha_dash');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|alpha_dash');

		if ($this->form_validation->run() == FALSE){
			$this->load->view('login_form');
			
		}else{

			$this->load->model('users');
			$data = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
				);
			$result = $this->users->check_user($data);
			if ($result != FALSE){
				$session_data = array(
					'username' => $result[0]->username);
				$this->session->set_userdata('logged_in', $session_data);
				$this->load->view('admin_page');
			}else{
				$this->load->view('welcome_message');
			}

		}
	}
}