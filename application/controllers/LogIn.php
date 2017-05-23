<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accounts extends CI_Controller {


	public function index()
	{
		sec_session_start();
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
			$this->load->model('sessions');
			$data = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
				);
			$result = $this->users->check_user($data);
			if ($result != FALSE){
				$session_data = array(
					'username' => $result[0]->username,
					'name' => $result[0]->name,
					'bday' => $result[0]->birthday,
					'addr' => $result[0]->address,
					'logged_in' => true);
				$this->session->set_userdata($session_data);
				sec_session_start();
				$data = array(
					'username' => $session_data['username'],
					'id' => session_id()
					);
				$this->sessions->update_session($data);
				$this->load->view('admin_page');
			}else{
				$this->load->view('welcome_message');
			}

		}
	}
	public function profile(){
		sec_session_start();
		$this->session->set_userdata('view_me', true);
		$this->load->view('admin_page');
	}

	public function others(){
		sec_session_start();
		$this->load->model('users');

	}
	public function logout

}