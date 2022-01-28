<?php

namespace controllers;

use repository\MessageRepository;

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
            $user_id = $_POST['id'];
            $message = $_POST['message'];

            (new MessageRepository)->sendMessage($user_id, $message);
            return self::JSONResponse(["response" => "ok"]);
        } else {
            return self::JSONResponse(["response" => "need to be post method"]);
        }

    }
}