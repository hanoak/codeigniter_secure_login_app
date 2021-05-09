<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {


    public function __construct() {
        parent::__construct();

        $this->load->model('Login_model');
        $this->lang->load('login_messages');

    }

    private function loginCheck() {

        if($this->isLoggedIn()) {
            redirect('admin');
        }

    }

    public function index() {

        $this->loginCheck();
        $data['token'] = password_hash($this->hasher->generateVerifyKey(), PASSWORD_DEFAULT);
        $this->session->set_userdata($data);
        $this->load->view('loginpage', $data);
    }

    public function validate_login() {

        $this->loginCheck();

    	if ($this->input->post()){

            $token = $this->input->post('token', TRUE);

            if(!(empty($token)||is_null($token))) {

                if($this->verifyToken($token)) {

            	    $inValidCred = array('token' => $token, 'error' => $this->lang->line('INCRED')); 
            	    $UnableLogin = array('token' => $token, 'error' => $this->lang->line('UNLOG'));
                    $today = date('Y-m-d');
                    $ip = $this->input->ip_address();                   
                    
					if ($this->form_validation->run('login') == FALSE) {

                        $this->load->view('loginpage',  array('token' => $token));

                      } else {
                                
            			$email = $this->sanitize_login_input($this->input->post('emailid', TRUE));
            			$password = $this->sanitize_login_input($this->input->post('pwd', TRUE));

        				$cred = $this->Login_model->getSaltPassIfActive($email);

        					if( is_null($cred) ) {

                                $this->load->view('loginpage',  $inValidCred);

        					} else {

        						if ( $this->hasher->verifyPassword($cred->salt, $cred->pwd, $password) ) {

        							$loginData['aid'] = $cred->aid;
        							$loginData['ip_address'] = $this->input->ip_address();
        							$loginData['login_time'] = date('Y-m-d H:i:s');

                                    $nVK = $this->hasher->generateVerifyKey();

                                    $up1 = $this->Login_model->updateVerifyKey($cred->aid,$nVK);

                                    $up2 = $this->Login_model->setUserLoginDetails($loginData);

        							if( $up1 && $up2 ) {

        								$this->setUserSession($cred, $nVK);

        								redirect('admin');

        							} else { $this->load->view('login', $UnableLogin); }

        						} else { $this->load->view('loginpage',  $inValidCred); }
                     		
        					}        				
                    }

                }  else { redirect('login'); }

            }  else { redirect('login'); }

    	} else { redirect('login'); }

    }

	private function sanitize_login_input($str) { 	
    	return strip_tags(strip_tags( preg_replace("/\s+/", "", $str) ));   	
    }

    private function setUserSession($userData, $newVerifyKey) {

    	$sessData['aid'] = $userData->aid;
    	$sessData['verify_key'] = $newVerifyKey;

    	$hash = $userData->aid . $newVerifyKey . SESSION_KEY;

    	$sessData['hash'] = password_hash($hash, PASSWORD_DEFAULT);

    	$this->session->set_userdata($sessData);
    }

    private function verifyToken($token) {

        $sesToken = $this->session->userdata("token");
        if(! is_null($token)) {

            if($token == $sesToken) { return TRUE; }

        }

        return FALSE;
    }


    public function isLoggedIn() {

        $aid = $this->session->userdata("aid");
        $verify_key = $this->session->userdata("verify_key");
        $hash = $this->session->userdata("hash");

        if(!(is_null($aid)||is_null($verify_key)||is_null($hash))) {

            if(password_verify($aid . $verify_key . SESSION_KEY, $hash)) {

                $sessData = array('aid' => $aid,'verify_key' => $verify_key);

                if($this->Login_model->verifySessDataInDB($sessData)) {

                    return TRUE;

                }

            }
           
            $this->session->unset_userdata(array('aid','verify_key','hash'));
            $this->session->sess_destroy();
            redirect('login');

        }

        return FALSE;

    }

    public function logout() {

        if($this->isLoggedIn()) {

            $aid = $this->session->userdata("aid");
            $logoutTime = date('Y-m-d H:i:s');

            $this->Login_model->updateVerifyKey($aid, $this->hasher->generateVerifyKey());

            $this->Login_model->setUserLogoutDetails($aid,$logoutTime);

            $userData = array('aid','verify_key','hash','token');

            $this->session->unset_userdata($userData);
            $this->session->sess_destroy();
        }
        
        redirect('login');
    }

   
}