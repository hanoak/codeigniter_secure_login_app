<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasher {

    private $key = "MY_key@101Cars101KEY";

    public function hashPassword($password) {
        $salt = $this->generateSalt();
        $tempPassword = $this->key . $salt . $password;
        $hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);
        return array('hashedPassword' => $hashedPassword, 'salt' => $salt); 
    }

    private function generateSalt() {
        $length = 20;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function verifyPassword($saltinDB, $pwdinDB, $userPWD) {
        $tempPassword = $this->key . $saltinDB . $userPWD;
        return password_verify($tempPassword, $pwdinDB);
    }

    public function generateVerifyKey() {
        $length = rand(15, 30);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}