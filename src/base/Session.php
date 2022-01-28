<?php

namespace base;

use models\User;

class Session
{

    public static function is_logged($user): bool
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
    }

    public static function getId(): int
    {
        /** @var User $user */
        $user = $_SESSION['user'];
        return $user->getId();
    }
}