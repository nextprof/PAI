<?php

namespace controllers;

class DefaultController extends AppController {

    public function index()
    {
        return $this->render('login');
    }
}