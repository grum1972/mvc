<?php

namespace App\Controllers;


use Core\Context;
use Core\Controller as BaseController;
use App\Models\Message;
use Core\View;
use Intervention\Image\ImageManagerStatic as Image;

class Twig1 extends BaseController
{
    protected static $imagePath;

    public function indexAction()
    {
        $this->user = $this->getUser();
        if (!$this->user) {
            return;
        }
        $this->view->setRenderType(View::RENDER_TYPE_TWIG);
        $this->view->user = $this->user;
        $this->view->name = $this->user->getName();
        $this->tpl = 'blog.twig';
        $messages = Message::getMessages(10);
        $this->view->messages = $messages;
        $this->imageAction();
    }

    public function imageAction()
    {

        $inputImage = getcwd() . '/images/eleph.png';
        $outputImage = getcwd() . '/images/eleph_new.png';
        Image::make($inputImage)
            ->resize(200, null, function ($image) {
                $image->aspectRatio();
            })
            ->text('I learn PHP', 100, 80, function($font) {
                $font->file(getcwd() . '/images/OpenSans-Bold.ttf');
                $font->size(24);
                $font->color(array(0,0, 255, 0.5));
                $font->align('center');
                $font->valign('center');})
            ->save($outputImage, 80);
    }

}