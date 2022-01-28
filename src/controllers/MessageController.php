<?php

namespace controllers;

use base\Session;
use repository\MessageRepository;

class MessageController extends AppController
{
    public function messages()
    {
        $contacts = (new MessageRepository())->getContacts();
        return $this->render('messages', ["user" => Session::getUser(), "contacts" => $contacts]);
    }
}