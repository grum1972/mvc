<?php

namespace App\Controllers;

use Core\Controller as BaseController;
use App\Models\User;

class Login extends BaseController
{

    public function authAction()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = User::getByEmail($email);
        $errors = [];

        if (!$user) {
            $errors[] = 'Неверный логин и пароль';
        } elseif ($user->getPassword() !== User::getPasswordHash($password)) {
            $errors[] = 'Неверный логин и пароль';
        }

        if (!empty($errors)) {
            $this->view->errors = $errors;
            $this->tpl = 'Login/index.phtml';
            return;
        } else {
            $this->_render = false;
        }
        $this->session->authUser($user->getId());
    }
}

