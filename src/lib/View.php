<?php

namespace Pepew\Instagram\lib;

class View{

    private $data;

    function __construct(){

    }

    public function render(string $name, array $data = []){
        $this-> data = $data;
        require 'src/views/'.$name.'.php';

    }

}