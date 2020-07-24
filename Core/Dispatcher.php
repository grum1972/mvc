<?php

namespace Core;
class Dispatcher
{
    const DEFAULT_CONTROLLER = 'Index';
    const DEFAULT_ACTION = 'index';

    private $_controllerName = '';
    private $_actionName = '';




    protected function getRoutes()
    {
        return [
            'Login' => [
                'register' => 'register.register'],
            'Register' => [
                'index' => 'register.index'],
        ];
    }

    public function dispatch()
    {
        $request = Context::i()->getRequest();
        $controllerName = $request->getControllerName();
        $actionName = $request->getActionName();


        if (!$controllerName || !$this->check($controllerName)) {
            $this->_controllerName = self::DEFAULT_CONTROLLER;
        } else {

            $this->_controllerName = ucfirst(strtolower($controllerName));
        }
        if (!$actionName || !$this->check($actionName)) {

            $this->_actionName = self::DEFAULT_ACTION;
        } else {

            $this->_actionName = strtolower($actionName);
        }


    }

    public function check(string $key)
    {
        return preg_match('/[a-zA-Z0-9]+/', $key);
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