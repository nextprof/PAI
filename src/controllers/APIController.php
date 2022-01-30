<?php

namespace controllers;

use base\Guard;

class APIController extends AppController
{

    public static function JSONResponse($object): string
    {
        if (!Guard::Authenticated())
            return Guard::Redirect();

        header('Content-type: application/json');
        http_response_code(200);
        return json_encode($object);
    }
}