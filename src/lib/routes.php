<?php

use Pepew\Instagram\controllers\Signup;
use Pepew\Instagram\controllers\Login;
use Pepew\Instagram\controllers\Home;
use Pepew\Instagram\controllers\Actions;
use Pepew\Instagram\controllers\Profile;

$router = new \Bramus\Router\Router();
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../config/');
$dotenv -> load();

function notAuth(){

    if(!isset($_SESSION['user'])){
        header('location: /instagram/login');
        exit();
    }

}

function Auth(){
    if(isset($_SESSION['user'])){
        header('location: /instagram/home');
        exit();
    }
}

$router -> get('/', function(){
    echo "inicio <br/>";
    
});

$router -> get('/signup', function(){
    auth();
    $controller = new Signup;
    $controller -> render('signup/index');
});

$router -> post('/register', function(){
    auth();
    $controller = new Signup;
    $controller -> register();
});

$router -> get('/home', function(){
    notAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Home($user);
    $controller -> index();
});

$router -> get('/login', function(){
    auth();
    $controller = new Login;
    $controller -> render('login\index');
});

$router -> post('/auth', function(){
    auth();
    $controller = new Login;
    $controller -> auth();
});

$router -> post('/publish', function(){
    notAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Home($user);
    $controller -> store();
});

$router -> post('/addLike', function(){
    notAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Actions($user);
    $controller -> like();
});

$router -> get('/signout', function(){
    notAuth();
    unset($_SESSION['user']);
    header('Location: /instagram/login');
});

$router -> get('/profile', function(){
    notAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Profile;
    $controller -> getUserProfile($user);
});

$router -> get('/profile/{username}', function($username){
    notAuth();
    $controller = new Profile;
    $controller -> getUsernameProfile($username);
});

$router -> run();