<?php
class Users extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
        $this->load->model('users');
    }
 
    public function index(){
        $data['users'] = $this->users->get_users(FALSE);
        $data['title'] = 'Users';
 
        $this->load->view('templates/users_header', $data);
        $this->load->view('users/index', $data);
    }
 
    public function view($id = NULL){
        $data['users_item'] = $this->users->get_users($id);
        
        if (empty($data['users_item'])){
            show_404();
        }
 
        $data['title'] = "";
 
        $this->load->view('templates/users_header', $data);
        $this->load->view('users/profile', $data);
    }
}