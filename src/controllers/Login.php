<?php

namespace Pepew\Instagram\Controllers;

use Pepew\Instagram\lib\Controller;
use Pepew\Instagram\models\User;

class Login extends Controller {

    public function __construct(){
        parent::__construct();
    }

    public function auth(){

        $username = $this->post('username');
        $password = $this->post('password');

        if(is_null($username) && 
        is_null($password) ){
            header('Location: /instagram/login');
            
        }

        if(!User::exist($username)){
            error_log('Usuario no encontrado');
            header('Location: /instagram/login');
        }

        $user = User::getUser($username);

        if(!$user -> comparePassword($password)){
            error_log('No es la misma password');
            header('Location: /instagram/login');
        }

        $_SESSION['user'] = serialize($user);
        header('Location: /instagram/home');
    }

}