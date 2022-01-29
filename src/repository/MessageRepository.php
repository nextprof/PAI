<?php

namespace repository;

use base\Session;
use models\Message;
use PDO;

class MessageRepository extends Repository
{

    public function getUserMessagesWith(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM messages WHERE (id_from = :id and  id_to = :my_id) or (id_to = :id and id_from=:my_id )order by id ASC;
        ');
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->bindValue(':my_id', Session::getId(), PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Message::class);

        return $stmt->fetchAll();
    }

    public function getContacts($id)
    {
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM v_user_contact_list(:id)
        ");

        $stmt->bindValue(':id', $id, PDO::PARAM_STR);

        $stmt->execute();

        $fetched = $stmt->fetchAll();

        $messages = [];

        foreach ($fetched as $row) {
            $messages[] = ["id" => $row["user_id"], "name" => $row['user_name']];
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