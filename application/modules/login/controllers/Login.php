<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {


    public function __construct() {
        parent::__construct();

        $this->load->model('Login_model');
        $this->lang->load('login_messages');

    }
    public function index() {
        
        $data['token'] = password_hash($this->hasher->generateVerifyKey(), PASSWORD_DEFAULT);
        $this->session->set_userdata($data);
        $this->load->view('loginpage', $data);
    }

   
}