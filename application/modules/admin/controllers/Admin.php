<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

    private $aid;
    private $token;

    public function __construct() {
        parent::__construct();

        $this->load->module('login');        

        if(!($this->login->isLoggedIn())) {
            redirect('login');
        }

        $this->load->model('Admin_model');
        $this->aid = $this->session->userdata("aid");

    }

    public function index() { 

        $this->setToken();
        $data['token'] = $this->token;
        $data['page'] = 'Dashboard';

        //use html_escape() method to escape the string while rendering it in your views to avoid XSS attack
        // I'm not rendering any data from DB in any views right now, but you should...
        // exmaple: html_escape($this->Admin_model->dataFromDataBase());

        $data['body'] = $this->load->view('dashboard', $data, TRUE);
        $this->load->view('layout', $data);
    }

    private function setToken() {

        $this->token = password_hash($this->hasher->generateVerifyKey(), PASSWORD_DEFAULT);
        $this->session->set_userdata(array('token' => $this->token ));
    }

    private function verifyToken() {

        if($this->input->post('token', TRUE) != $this->session->userdata("token")) {
            $this->login->logout();
        }
    }
   
}