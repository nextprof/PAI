<?php

namespace repository;

use base\Session;
use models\User;
use PDO;

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u WHERE email = :email limit 20;
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['id'],
            $user['email'],
            $user['password'],
            $user['username']
        );
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, username)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $user->getUsername()
        ]);
    }

    public function findUserWithName($query): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT id as id, username as name 
            FROM users u 
            WHERE username like :name and id != :my_id
            limit 10;
        ');
        $stmt->bindValue(':name', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->bindValue(':my_id', Session::getId(), PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result != false ? $result : [];
    }

}