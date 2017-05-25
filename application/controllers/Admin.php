<?php
class Admin extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect(base_url(). 'index.php/accounts');
        }
        $this->load->model('admin_model');
    }
 
    public function index(){
        $data['users'] = $this->admin_model->get_users(FALSE);
        $data['title'] = 'Users';
 
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/index', $data);
    }
 
    public function profile($id = NULL){
        $data['users_item'] = $this->admin_model->get_users($id);
        
        if (empty($data['users_item'])){
            show_404();
        }
 
        $data['title'] = "";
 
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/profile', $data);
    }
    
    public function create(){
        $this->load->helper('form');
        $this->load->library('form_validation');
 
        $data['title'] = 'Create a User';
 
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('birthday', 'Birthday', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
 
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/create');
        }
        else{
            $this->admin_model->set_users(0);
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/success');
        }
    }
    
    public function edit(){
        $id = $this->uri->segment(3);
        
        if (empty($id)){
            show_404();
        }
        
 
        $data['title'] = 'Edit a User';        
        $data['users_item'] = $this->admin_model->get_users_by_id($id);
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('birthday', 'Birthday', 'required');
       

        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/edit', $data);
        }
        else{
            $this->admin->set_users($id);
            //$this->load->view('users/success');
            redirect( base_url() . 'index.php/admin');
        }
    }

    public function online_users(){
    	$data['title'] = 'Online Users';
    	$this->load->view('templates/admin_header', $data);
    	$this->load->model('sessions_model');  
    	$data['users'] = $this->sessions_model->online_users(time()); 
    	$this->load->view('admin/online', $data); 

    }
    
    public function delete(){
        $id = $this->uri->segment(3);
        
        if (empty($id)){
            show_404();
        }
                
        $users_item = $this->admin_model->get_users_by_id($id);
        
        $this->admin_model->delete_users($id);        
        redirect( base_url() . 'index.php/admin');        
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

    
}
?>