<?php

namespace repository;

use models\User;
use PDO;

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u WHERE email = :email
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

    public function findUserWithName($query)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u WHERE username like :name limit 10;
        ');
        $stmt->bindParam(':name', $query, PDO::PARAM_STR);
        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return new $users;
    }

}