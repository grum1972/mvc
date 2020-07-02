<?php

namespace Core;

class Request
{
    private $_controllerName = '';
    private $_actionName = '';


    public function __construct()
    {
        $parts = explode('/', $_SERVER['REQUEST_URI']);


        if ($_POST['login'] == 'Login') {
            $this->_controllerName = 'Login';
            $this->_actionName = 'index';
        } elseif ($_POST['login'] == 'Register') {
            $this->_controllerName = 'Register';
            $this->_actionName = 'index';

        } else {
            $this->_controllerName = $parts[1] ?? '';
            $this->_actionName = $parts[2] ?? '';
        }

    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->_controllerName;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->_actionName;
    }




}