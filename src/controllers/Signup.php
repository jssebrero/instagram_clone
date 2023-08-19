<?php 

namespace Pepew\Instagram\Controllers;

use Pepew\Instagram\lib\Controller;
use Pepew\Instagram\lib\UtilImages;
use Pepew\Instagram\models\User;

class Signup extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function register(){
        $username = $this->post('username');
        $password = $this->post('password');
        $profile = $this->file('profile');

        if(is_null($username) && 
        is_null($password) && 
        is_null($profile)){
            $this->render('errors/index');
            //return;
        }

        $picturaName = UtilImages::storeImage($profile);
        $user = new User($username, $password);
        $user -> setProfile($picturaName);
        $user -> save();
        //AL NO ESTAR EN RAÍZ DE APACHE SE LE DEBE PONER EL NOMBRE DE LA CARPETA DONDE ESTA ALOJADO EL PROYECTO PARA QUE PUEDA MOSTRARSE 
        header('Location: /instagram/login');

    }

}