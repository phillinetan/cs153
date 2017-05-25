<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accounts extends CI_Controller {

	
	public function index()
	{
		sec_session_start();
		if (isset($this->session->level)){
			if ($this->session->level == 1){
				redirect( base_url() . 'index.php/admin'); 
			}else{
				$this->load->view('user/profile');
			}
		}else{
			$this->load->view('login_form');
		}
		
	}
	public function check_attempt(){
		$this->load->model('attempts_model');
		$count = $this->attempts_model->count_attempt($_SERVER['REMOTE_ADDR']);
		return $count[0]->attempts;
	}
	public function user_login_process(){
		$attempts = $this->check_attempt();
        if ($attempts >=3){
        	$data['error_msg'] = "too many attempts. try again after 10 minutes";
        	$this->load->view('login_form', $data);
        	return false;
        }else{
		/*form_validation(field_name, human_name for error, rules)*/
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|alpha_dash');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|alpha_dash');

			if ($this->form_validation->run() == FALSE){
				$this->load->view('login_form');
				
			}else{

				$this->load->model('accounts_model');
				$this->load->model('sessions_model');
				$data = array(
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password'))
					);
				$result = $this->accounts_model->check_user($data);
				if ($result != FALSE){
					//sec_session_start();
					$session_data = array(
						'name' => $result[0]->name,
						'username' => $result[0]->username,
						'logged_in' => true,
						'level' => $result[0]->user_level
						);
					$this->session->set_userdata($session_data);
					$this->sessions_model->update_session($session_data['username']);
					if ($this->session->level == 1){
						redirect( base_url() . 'index.php/admin'); 
					}
					else{
						redirect( base_url() . 'index.php/users');; //temporary 
					}
				}else{
					$this->load->model('attempts_model');
					$attempt = array(
						'username' => $data['username'],
						'address' => $_SERVER['REMOTE_ADDR'],
						'time' => time()
						);
					$this->attempts_model->add_attempt($attempt);
					$this->load->view('login_form');
				}

			}
		}
	}
	public function profile(){
		//sec_session_start();
		$this->load->model('accounts_model');
		$this->session->name = true;
		$this->load->view('admin_page');
	}

	public function others(){
		//sec_session_start();
		$this->load->model('accounts_model');

	}
}	
?>