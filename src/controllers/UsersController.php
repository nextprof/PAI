<?php

namespace controllers;

use repository\UserRepository;

class UsersController extends APIController
{

    public function users_search($query)
    {
        return self::JSONResponse((new UserRepository())->findUserWithName($query));
    }
}