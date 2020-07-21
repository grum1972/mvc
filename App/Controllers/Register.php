<?php

namespace App\Controllers;

use Core\Controller as BaseController;
use App\Models\User;

class Register extends BaseController
{
    public function indexAction()
    {

    }

    public function registerAction()
    {

        $name = (string)$_POST['name'];
        $email = (string)$_POST['email'];
        $password = (string)$_POST['password'];
        $password2 = (string)$_POST['password_2'];


        $errors = [];

        if (!$name || !$password) {
            $errors[] = 'Не заданы имя и пароль';
        }

        if (!$email) {
            $errors[] = 'Не задан email';
        }
        if ($password !== $password2) {
            $errors[] = 'Введенные пароли не совпадают';
        }
        if (mb_strlen($password) < 5) {
            $errors[] = 'Пароль слишком короткий';
        }

        if (!empty($errors)) {
            $this->view->errors = $errors;
            $this->tpl = 'Register/index.phtml';
            return;
        } else {

            $this->tpl = 'User/blog.phtml';
        }

        $userData = [
            'name' => $name,
            'created_at' => date('Y-m-d H:i:s'),
            'password' => $password,
            'email' => $email,
        ];

        $user = new User($userData);
        $user->save();

        $this->session->authUser((int)$user->getId());

    }
}