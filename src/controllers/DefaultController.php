<?php

namespace controllers;

use base\Session;
use repository\ExercisesRecordsRepository;

class DefaultController extends AppController
{

    public function index()
    {
        return $this->render('login');
    }

    public function messages()
    {
        return $this->render('messages', ["user" => Session::getUser()]);
    }

    public function exercises()
    {

        $exercises = (new ExercisesRecordsRepository())->exercise_type_list();
        return $this->render(
            'exercises',
            [
                "user" => Session::getUser(),
                "exercises" => $exercises
            ]);
    }
}