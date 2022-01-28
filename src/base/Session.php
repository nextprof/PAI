<?php

namespace base;

use models\User;

class Session
{

    public static function is_logged(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function login($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
    }

    public static function getId(): int
    {
        /** @var User $user */
        $user = $_SESSION['user'];
        return $user->getId();
    }

    public static function getUser()
    {
        return json_encode($_SESSION['user']);
    }
}