<?php

namespace Core;
class DB
{
    /** @var \PDO */
    private $_pdo;

    private function getConnection()
    {
        if (!$this->_pdo) {
            $this->_pdo = new \PDO('mysql:host=localhost;dbname=blog', 'root', 'root');

        }
        return $this->_pdo;
    }

    public function fetchAll(string $query, $_method, array $params = [])
    {
//        echo '<pre>';
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);
        $prepared->execute($params);
        $data=$prepared->fetchAll(\PDO::FETCH_ASSOC);
        echo $_method;
        echo '<br>';
        return $data;
    }

    public function fetchOne(string $query, $_method, array $params = [])
    {
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);
        $ret = $prepared->execute($params);
        var_dump($ret);
        $data=$prepared->fetchAll(\PDO::FETCH_ASSOC);
        if (!$data) {
            return false;
        }
        return reset($data);
    }

    public function exec(string $query, $_method, array $params = [])
    {
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);
        $ret = $prepared->execute($params);
        var_dump($ret);
        $affectedArrows = $prepared->rowCount();
        var_dump($affectedArrows);
        return true;
    }

    public function LastInsertID()
    {
        return $this->getConnection()->lastInsertId();
    }

}

