<?php

namespace Core;
class DB
{
    /** @var \PDO */
    private $_pdo;

    private function getConnection()
    {
        if (!$this->_pdo) {
            $this->_pdo = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

        }
        return $this->_pdo;
    }

    public function fetchAll(string $query, array $params = [])
    {

        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);
        $prepared->execute($params);
        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function fetchOne(string $query, array $params = [])
    {
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);
        $ret = $prepared->execute($params);
        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        if (!$data) {
            return false;
        }
        return reset($data);
    }

    public function exec(string $query, array $params = [])
    {
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);
        $ret = $prepared->execute($params);
        $affectedArrows = $prepared->rowCount();

        return true;
    }

    public function LastInsertId()
    {

        return $this->getConnection()->lastInsertId();
    }

}

