<?php

namespace controllers;

use base\Session;
use repository\MessageRepository;
use repository\UserRepository;

class MessageAPIController extends APIController
{

    public function message_get(): string
    {
        $user_id = $_GET['id'];
        return self::JSONResponse((new MessageRepository)->getUserMessagesWith($user_id));
    }

    public function message_send(): string
    {
        if ($this->isPost()) {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            $user_id = $decoded['id'];
            $message = $decoded['message'];

            (new MessageRepository)->sendMessage($user_id, $message);
            return self::JSONResponse(["response" => "ok", "recipient" => $user_id]);
        } else {
            return self::JSONResponse(["response" => "need to be post method"]);
        }

    }

    public function contact_list(): string
    {
        $user_id = Session::getId();
        return self::JSONResponse((new MessageRepository)->getContacts($user_id));

    }

    public function contact_search(): string
    {
        if ($this->isPost()) {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            $query = $decoded['query'];

            $users = (new UserRepository())->findUserWithName($query);
            return self::JSONResponse($users);
        } else {
            return self::JSONResponse(["response" => "need to be post method"]);
        }
    }
}