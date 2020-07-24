<?php

namespace App\Controllers;
use Core\Controller as BaseController;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class Swiftmailer extends BaseController
{
    public function indexAction()
    {
// Create the Transport

        $transport = (new Swift_SmtpTransport('smtp.spaceweb.ru', 465, 'ssl'))
            ->setUsername('kotov@avtopoezd31.ru')
            ->setPassword('*****');

// Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

// Create a message
        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom(['kotov@avtopoezd31.ru' => 'Kotov'])
            ->setTo(['grum1972@gmail.com' => 'A name'])
            ->setBody('Here is the message itself');

// Send the message
        $result = $mailer->send($message);

        $this->_render = false;
    }
}