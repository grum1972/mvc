<?php

namespace App\Controllers;

use App\Models\Message;
use Core\Context;
use Core\Controller as BaseController;

class Index extends BaseController
{
    protected $user;

    public function indexAction()
    {

        $this->user = $this->getUser();
        if (!$this->user) {
            return;
        }
        $this->view->user = $this->user;
        $this->view->name = $this->user->getName();

        $this->tpl = 'User/blog.phtml';
        $messages = Message::getMessages(10);
        $this->view->messages = $messages;

    }

    public function deleteMessageAction()
    {
        $messageId = (int) $_GET['id'];
        Message::deleteMessage($messageId);

        $this->_render = false;
        $this->tpl = 'mvc/';
    }

    // Получить последние N записей

    public function lastMessagesAction()
    {
        $this->user = $this->getUser();
        if (!$this->user) {
            return;
        }
        $this->view->user = $this->user;
        $this->view->name = $this->user->getName();

        $this->tpl = 'User/blog.phtml';
        $messages = Message::getMessages(3,true);
        $this->view->messages = $messages;

    }

    public function addMessageAction()
    {
        $this->user = $this->getUser();
        if (!$this->user) {
            return;
        }
        $text = (string)$_POST['text'];
        if (!$text) {
            $this->error('Сообщение не может быть пустым');
        }

        $message = new Message([
            'text' => $text,
            'author_id' => $this->getUserId(),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if (isset($_FILES['image']['tmp_name'])) {
            $message->loadFile($_FILES['image']['tmp_name']);
        }

        $message->save();
        $this->_render = false;
        $this->tpl = 'mvc/';

    }

}