<?php
namespace App\Controllers;

use Core\Controller as BaseController;

class Login extends BaseController
{
    public function indexAction(){
        echo '9999';
        //$this->_render=false;
    }
    public function loginAction()
    {
        echo '7777';//$this->_render=false;
    }

    public function authAction()
    {
        $this->_render=false;
        echo '5555';
    }
}

