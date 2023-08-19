<?php

namespace Pepew\Instagram\controllers;

use Pepew\Instagram\lib\Controller;
use Pepew\Instagram\models\PostImage;
use Pepew\Instagram\models\User;

class Actions extends Controller {
    
    public function __construct(private User $user) {
        parent::__construct();
    }

    public function like(){

        $post_id = $this->post('post_id');
        $origin = $this->post('origin');

        $post = PostImage::get($post_id);
        $post -> addLike($this->user);

        header('Location: /instagram/'.$origin);
    }

}