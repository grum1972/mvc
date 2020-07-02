<?php

namespace App\Controllers;

use Core\Context;
use Core\Controller as BaseController;

class Index extends BaseController
{


    public function indexAction()
    {
        //echo '11';
        //$this->view->var = 'Hello';
        //include "App/Models/User.php";
//        $db = Context::i()->getDb();
//        $ret=$db->fetchOne("SELECT * FROM client WHERE id > :id ", __METHOD__, ['id' => 19]);
//        var_dump($ret);
//        $this->view->userModel = new \App\Models\ModelUser();

        //$user->setName('Oleg');
    }
    public function loginAction()
    {
        //$this->_render=false;

         echo __METHOD__;
    }

    public function registerAction()
    {
        //$this->_render=false;

        echo __METHOD__;
    }


    public function userProfileAction()
    {
        include "../Models/User.php";
        $user = new User();
        $user->load($_GET['id']);
        $this->view->user = $user;
    }

}