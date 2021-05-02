<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(

	'login' => array(
                array(
                        'emailid' => 'emailid',
                        'label' => 'Email-ID',
                        'rules' => 'required|max_length[50]|min_length[3]|valid_email'
                ),
                array(
                        'field' => 'pwd',
                        'label' => 'Password',
                        'rules' => 'required|max_length[30]|min_length[12]'
                )
        )

);