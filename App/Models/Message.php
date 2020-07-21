<?php


namespace App\Models;


use App\Models\User;
use Core\Context;


class Message
{
    private $id;

    private $text;
    private $createdAt;
    private $author_id;
    private $author;
    private $image;

    public function __construct(array $data)
    {
        $this->text = $data['text'];
        $this->createdAt = $data['created_at'];
        $this->author_id = $data['author_id'];
        $this->image = $data['image'] ?? '';

    }


    public static function getUserMessages(int $userId): array
    {
        $db = Context::i()->getDb();
        $data = $db->fetchAll('SELECT * FROM posts WHERE author_id=:userId',  [':userId' => $userId]);
        if (!$data) {
            return [];
        }

        $messages = [];
        foreach ($data as $elem) {
            $message = new self($elem);
            $message->id = $elem['id'];
            $messages[] = $message;
        }

        return $messages;
    }

    /**
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */

    public function getImage()
    {
        return $this->image;
    }


    public static function getMessages(int $limit, bool $lastMessages=false): array
    {
        $db = Context::i()->getDb();
        if ($lastMessages) {
            $data = $db->fetchAll("SELECT * FROM (SELECT * FROM posts ORDER BY id DESC LIMIT $limit) tempTable ORDER BY id");
        } else {
            $data = $db->fetchAll("SELECT * FROM posts LIMIT $limit");
        }

        if (!$data) {
            return [];
        }
        /** @var  $user User */

        $messages = [];
        foreach ($data as $elem) {
            $message = new self($elem);
            $message->id = $elem['id'];
            $user = User::getById($message->author_id);
            $message->author = $user;
            $messages[] = $message;
        }
        return $messages;
    }

    public static function getUserLastMessages(int $userId, int $limit): array
    {
        $db = Context::i()->getDb();
        $data = $db->fetchAll("SELECT * FROM (SELECT * FROM posts WHERE author_id=$userId ORDER BY id DESC LIMIT $limit) tempTable ORDER BY id ");

        if (!$data) {
            return [];
        }
        /** @var  $user User */

        $messages = [];
        foreach ($data as $elem) {
            $message = new self($elem);
            $message->id = $elem['id'];
            $user = User::getById($message->author_id);
            $message->author = $user;
            $messages[] = $message;
        }
        return $messages;
    }

    public static function deleteMessage(int $messageId)
    {
        $db = Context::i()->getDb();
        $query = "DELETE FROM posts WHERE id = $messageId";
        return $db->exec($query);
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    public function save()
    {
        $db = Context::i()->getDb();
        $res = $db->exec(
            'INSERT INTO posts (
                    text, 
                    created_at,
                    author_id,
                    image
                    ) VALUES (
                    :text, 
                    :created_at,
                    :author_id,
                    :image
                )',
            [
                ':text' => $this->text,
                ':created_at' => $this->createdAt,
                ':author_id' => $this->author_id,
                ':image' => $this->image
            ]
        );
        return $res;
    }

    public function loadFile(string $file)
    {
        if (file_exists($file)) {
            $this->image = $this->genFileName();
            move_uploaded_file($file, getcwd() . '/images/' . $this->image);
        }
    }

    private function genFileName()
    {
        return sha1(microtime(1) . mt_rand(1, 100000000)) . '.jpg';
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'author_id' => $this->author_id,
            'text' => $this->text,
            'created_at' => $this->createdAt,
            'image' => $this->image
        ];
    }
}