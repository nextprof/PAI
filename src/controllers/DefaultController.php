<?php

namespace controllers;

use base\Guard;
use repository\ExercisesRecordsRepository;

class DefaultController extends AppController
{

    public function index()
    {
        if (!Guard::Authenticated())
            return Guard::Redirect();

        return RedirectController::Redirect("/dashboard",);
    }

    public function messages()
    {
        if (!Guard::Authenticated())
            return Guard::Redirect();

        return $this->render('messages');
    }

    public function exercises()
    {
        if (!Guard::Authenticated())
            return Guard::Redirect();

        $exercises = (new ExercisesRecordsRepository())->exercise_type_list();
        return $this->render('exercises', ['exercises' => $exercises]);
    }

    public function dashboard()
    {
        if (!Guard::Authenticated())
            return Guard::Redirect();

        return $this->render('dashboard');
    }
}