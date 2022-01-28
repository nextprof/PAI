<?php

namespace controllers;

class DefaultController extends AppController {

    public function index()
    {
        $this->render('login');
    }
}