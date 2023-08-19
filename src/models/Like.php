<?php

namespace Pepew\Instagram\models;

use Pepew\Instagram\lib\Model;
use PDO;
use PDOException;

class Like extends Model {

    private int $id;

    public function __construct(private int $post_id,private int $user_id) {
        parent::__construct();

    }

    public function save(){

        try{
            error_log('post_id = ' . $this->post_id . '; user_id = ' . $this->user_id);
            $query = $this->prepare('INSERT INTO likes (post_id, user_id) VALUES(:post_id, :user_id)');
            $query->execute([
                'post_id'  => $this->post_id, 
                'user_id'  => $this->user_id
                ]);
            return true;
        }catch(PDOException $e){
            return false;
        }

    }

    public function setId($value){
        $this->id = $value;
    }

    public function setUserId($value){
        $this->user_id = $value;
    }

    public function getId(){
        return $this->id;
    }


    public function getPostId(){
        return $this->post_id;
    }
    public function getUserId(){
        return $this->user_id;
    }

}