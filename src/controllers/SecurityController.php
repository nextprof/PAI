<?php

namespace controllers;

use base\Session;
use models\User;
use repository\UserRepository;

class SecurityController extends AppController
{

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }


        Session::login($user);

        if (Session::is_logged()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/messages");
            return "redirect";
        } else {
            return $this->render('login', ['messages' => ['User has not been logged in']]);
        }


    }

    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['username'];

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Please provide proper password']]);
        }

        $user = new User(null, $email, password_hash($password, PASSWORD_DEFAULT), $name);

        try {
            $this->userRepository->addUser($user);
            return $this->render('login', ['messages' => ['You\'ve been successfully registered!']]);
        } catch (\PDOException $exception) {
            return $this->render('register', ['messages' => ['User with this username or email already exists.'.$exception->getMessage()]]);
        }
    }

    public function logout()
    {

        Session::logout();
        return $this->render('login', ['messages' => ['Logged out!']]);
    }
}