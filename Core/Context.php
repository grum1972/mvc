<?php

namespace Core;

class Context
{
    private static $_instance;
    /** @var Request */
    private $_request;
    /** @var Dispatcher */
    private $_dispatcher;
    /** @var DB */
    private $_db;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function i()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        //echo '<pre>';

        return self::$_instance;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->_request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->_request = $request;
    }

    /**
     * @return Dispatcher
     */
    public function getDispatcher(): Dispatcher
    {
        return $this->_dispatcher;
    }

    /**
     * @param Dispatcher $dispatcher
     */
    public function setDispatcher(Dispatcher $dispatcher)
    {
        $this->_dispatcher = $dispatcher;
    }

    /**
     * @return DB
     */
    public function getDb(): DB
    {
        return $this->_db;
    }

    /**
     * @param DB $db
     */
    public function setDb(DB $db)
    {
        $this->_db = $db;
    }


}