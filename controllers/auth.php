<?php
namespace FreelancerConnect\Controllers;
class Auth {
    //display auth form
    public function index(){
        require "views/login.php";
    }
    public function login(){
        $username = \input('username');
        $password = \input('password');
        echo $password;
    }
}