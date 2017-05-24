<?php
class Admin extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }
 
    public function index(){
        $data['users'] = $this->admin_model->get_users(FALSE);
        $data['title'] = 'Users';
 
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/index', $data);
    }
 
    public function view($id = NULL){
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
 
        if ($this->form_validation->run() === FALSE){
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
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
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
            redirect( base_url() . 'index.php/admin_model');
        }
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
}
?>