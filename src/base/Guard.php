<?php

namespace base;

use controllers\RedirectController;

class Guard
{
    public static function Authenticated(): bool
    {
        return Session::is_logged();
    }

    public static function Redirect(): string
    {
        return RedirectController::Redirect("/login","You need be logged in!");
    }
}