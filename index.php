<?php

set_include_path(get_include_path() . PATH_SEPARATOR . 'src');
spl_autoload_extensions('.php, .inc');
spl_autoload_register();

use base\Router;
use controllers\DefaultController;
use controllers\ProjectController;
use controllers\SecurityController;

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', DefaultController::class);
Router::get('projects', ProjectController::class);
Router::post('login', SecurityController::class);
Router::post('addProject', ProjectController::class);
Router::post('register', SecurityController::class);
Router::post('search', ProjectController::class);
Router::get('like', ProjectController::class);
Router::get('dislike', ProjectController::class);

Router::run($path);

