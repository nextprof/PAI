<?php

namespace controllers;

class APIController extends AppController
{

    public static function JSONResponse($object): string
    {
        header('Content-type: application/json');
        http_response_code(200);
        return json_encode($object);
    }
}