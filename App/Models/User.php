<?php

namespace App\Models;

use Core\Context;

class user
{
    private $id;
    private $name;
    private $password;
    private $email;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->password = $data['password'];;
        $this->createdAt = $data['created_at'];
        $this->email = $data['email'];
    }

    public function save()
    {
        $db = Context::i()->getDb();
        $res = $db->exec(
            'INSERT INTO users (
                    `name`, 
                    `password`, 
                    created_at,
                    email
                    ) VALUES (
                    :name, 
                    :password, 
                    :created_at,
                    :email
                )',
            __FILE__,
            [
                ':name' => $this->name,
                ':password' => self::getPasswordHash($this->password),
                ':created_at' => $this->createdAt,
                ':email' => $this->email,
            ]
        );

        $this->id = $db->lastInsertId();

        return $res;
    }





    public static function getByEmail(string $email)
    {
        $db = Context::i()->getDb();
        $data = $db->fetchOne(
            "SELECT * fROM users WHERE email = :email",
            __METHOD__,
            [':email' => $email]
        );
        if (!$data) {
            return null;
        }

        $user = new self($data);
        $user->id = $data['id'];
        return $user;
    }

    public static function getById(int $id): ?self
    {
        $db = Context::i()->getDb();
        $data = $db->fetchOne("SELECT * fROM users WHERE id = :id", __METHOD__, [':id' => $id]);
        if (!$data) {
            return null;
        }

        $user = new self($data);
        $user->id = $id;
        return $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPasswordHash(string $password)
    {
        return sha1($password . 'salt');
    }

    public function isAdmin()
    {
        return in_array($this->id, ADMIN);
    }


}