<?php

namespace Pepew\Instagram\controllers;

use Pepew\Instagram\lib\Controller;
use Pepew\Instagram\lib\UtilImages;
use Pepew\Instagram\models\User;
use Pepew\Instagram\models\PostImage;

class Home extends Controller{

    public function __construct(private User $user){
        parent::__construct();
    }

    public function index(){
        $posts = PostImage::getFeed();
        
        $this -> render('home/index',['user' => $this -> user, 'posts' => $posts]);
    }

    public function store(){
        $title = $this -> post('title');
        $image = $this -> file('image');

        if(is_null($title) && is_null($image)){
            header('Location: /instagram/home');
        }

        $fileName = UtilImages::storeImage($image);

        $post = new PostImage($title, $fileName);

        $this->user->publish($post);
        header('Location: /instagram/home');

    }
}