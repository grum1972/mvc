<?php

namespace App\Controllers;


use Core\Context;
use Core\Controller as BaseController;
use App\Models\Message;

class Api extends BaseController
{
    public function getUserMessageAction()
    {
        $userId = (int) $_GET['id'];
        $messages= Message::getUserLastMessages($userId,5);

        $data = array_map(function (Message $message) {
            return $message->getData();
        }, $messages);

        $this->tpl = 'User/api.phtml';
        $this->view->json = $this->response(['messages' => $data]);

    }

    public function response(array $data)
    {
        return json_encode($data);
    }
}