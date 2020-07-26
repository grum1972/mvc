<?php

namespace Core;

use Core\Exception\Error404;

class Application
{
    /** @var Context */
    private $_context;

    protected function _init()
    {
        $this->_context = Context::i();

        $request = new Request();
        $dispatcher = new Dispatcher();
        $db = new DB();

        $this->_context->setRequest($request);
        $this->_context->setDispatcher($dispatcher);
        $this->_context->setDb($db);

    }

    public function run()
    {

        try {
            $this->_init();

            $this->_context->getDispatcher()->dispatch();
            $dispatcher = $this->_context->getDispatcher();
            $controllerFileName = 'App\Controllers\\' . $dispatcher->getControllerName();

            if (!class_exists($controllerFileName)) {
                throw new Error404("CLASS {$controllerFileName} NOT exists");
            }

            /** @var Controller $controllerObj */
            $controllerObj = new $controllerFileName();

            $actionFuncName = $dispatcher->getActionName() . 'Action';


            if (!method_exists($controllerObj, $actionFuncName)) {
                throw new Error404("Action {$actionFuncName} NOT exists");
            }

            $view = new View();
            $controllerObj->view = $view;

            $session= new Session();
            $session->init();

            $controllerObj->setSession($session);
            $controllerObj->$actionFuncName();

            if ($controllerObj->needRender()) {
                if (!$tpl = $controllerObj->getTpl()) {
                    $tpl = $dispatcher->getControllerName() . '/' . $dispatcher->getActionName() . '.phtml';
                }

                $html = $view->render($tpl);
                echo $html;
            } else {
                header('Location: /');
            }

        } catch (Error404 $e) {
            header('HTTP/1.0 404 Not Found');
            trigger_error($e->getMessage());
        }
    }
}