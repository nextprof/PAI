<?php

namespace controllers;

class DashboardController extends AppController {

    public function dashboard()
    {
        return $this->render('dashboard');
    }
}