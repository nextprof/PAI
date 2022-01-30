<?php

namespace models;

class User
{
    private $id;
    private $email;
    private $password;
    private $username;

    public function __construct(
        int|null $id,
        string   $email,
        string   $password,
        string   $username
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

}