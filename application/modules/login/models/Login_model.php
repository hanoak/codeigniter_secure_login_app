<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model {

	 public function __construct() {
        parent::__construct();
    }

    private function trans_ends() {

    	if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function verifySessDataInDB($sessData) {

        $data = $this->db->select('*')
                        ->from('car_admins')
                        ->where($sessData)->get()->row();

        return ( is_null($data) ) ? FALSE : TRUE;

    }

    public function getSaltPassIfActive($email = '') {
        return $this->db->select('aid,pwd,salt,verify_key')
                        ->from('car_admins')
                        ->where('email', $email)
                        ->get()->row();
    }

    public function updateVerifyKey($aid, $key) {

        $this->db->trans_begin();

        $this->db->set('verify_key', $key)
                 ->where('aid', $aid)
                 ->update('car_admins');

        return $this->trans_ends();
    }

    public function setUserLoginDetails($arr) { 

        $this->db->trans_begin();

        $this->db->set('last_login_time', $arr['login_time'])
                 ->set('last_ip_address', $arr['ip_address'])
                 ->set('last_logout_time', NULL)
                 ->where('aid', $arr['aid'])
                 ->update('car_admins');


        return $this->trans_ends();

    }

    public function setUserLogoutDetails($aid,$logoutTime) { 

        $this->db->trans_begin();

        $this->db->set('last_logout_time', $logoutTime)
                 ->where('aid', $aid)
                 ->update('car_admins');        

        return $this->trans_ends();
    }



}