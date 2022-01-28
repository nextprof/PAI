<?php

namespace repository;

use base\Session;
use models\Message;
use PDO;

class ExercisesRecordsRepository extends Repository
{

    public function getUserMessagesWith(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM messages WHERE id_from = :id or id_to = :id order by id DESC;
        ');
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Message::class);

        return $stmt->fetchAll();
    }

    public function getContacts()
    {
        $stmt = $this->database->connect()->prepare('
            select users.id, users.username
                from (SELECT id_from as id
                      from messages
                      where id_to = :id
                      union
                      select id_to as id
                      from messages
                      where id_from = :id) messages
                         join users on users.id = messages.id;
        ');

        $stmt->bindValue(':id', Session::getId(), PDO::PARAM_INT);

        $messages = [];

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $messages += ["id" => $row["id"], "usernamme" => $row['username']];
        }
        return $messages;
    }

    public function sendMessage($id, $content)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO messages (id_from, id_to, message) VALUES (:from,:to,:message);
        ');

        $stmt->bindValue(':from', Session::getId(), PDO::PARAM_INT);
        $stmt->bindValue(':to', $id, PDO::PARAM_INT);
        $stmt->bindValue(':message', $content, PDO::PARAM_STR);

        $stmt->execute();
    }

}