<?php

namespace repository;

use base\Database;

class Repository {
    protected $database;

    public function __construct()
    {
        $this->database = new Database();
    }
}