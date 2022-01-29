<?php

namespace controllers;

use repository\ExercisesRecordsRepository;

class DefaultController extends AppController
{

    public function index()
    {
        return $this->render('login');
    }

    public function messages()
    {
        return $this->render('messages');
    }

    public function exercises()
    {
        $exercises = (new ExercisesRecordsRepository())->exercise_type_list();
        return $this->render('exercises', ['exercises' => $exercises]);
    }

    public function dashboard()
    {
        return $this->render('dashboard');
    }
}