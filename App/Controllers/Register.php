<?php

namespace App\Controllers;

use Core\Controller as BaseController;

class Register extends BaseController
{
    public function indexAction()
    {
        echo '9999';

    }

    public function registerAction()
    {

        //echo '8888';
        $name = (string)$_POST['name'];
        $email = (string)$_POST['email'];
        $password = (string)$_POST['password'];
        $password2 = (string)$_POST['password_2'];


        if (!$name || !$password) {
            //echo 'Не заданы имя и пароль';
            return 1;
        }

       if (!$email) {
           echo 'Не задан email';

           return;

       }
       if ($password !== $password2) {
           echo 'Введенные пароли не совпадают';

           return;
       }
       if (mb_strlen($password) < 5) {
            echo 'Пароль слишком короткий';
           return;
        }


//        $userData = [
//            'name' => $name,
//            'created_at' => date('Y-m-d H:i:s'),
//            'password' => $password,
//            'email' => $email,
//        ];
//        $user = new User($userData);
//        $user->save();
//
//        $this->session->authUser($user->getId());
    }
}