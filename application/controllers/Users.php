<?php
class Users extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url(). 'index.php/accounts');
        }
        $this->load->model('user_model');
    }
 
    public function index(){
        $data['users'] = $this->user_model->get_users(FALSE);
        $data['title'] = 'Users';
 
        $this->load->view('templates/users_header', $data);
        $this->load->view('users/index', $data);
    }
 
    public function view($id = NULL){
        $data['users_item'] = $this->user_model->get_users($id);
        
        if (empty($data['users_item'])){
            show_404();
        }
 
        $data['title'] = "";
 
        $this->load->view('templates/users_header', $data);
        $this->load->view('users/profile', $data);
    }
    public function logout(){
    $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
    session_destroy();
    redirect(base_url(). 'index.php/accounts');
}
    public function online_users(){
        $data['title'] = 'Online Users';
        $this->load->view('templates/users_header', $data);
        $this->load->model('sessions_model');  
        $data['users'] = $this->sessions_model->online_users(time()); 
        $this->load->view('users/online', $data); 

    }
}