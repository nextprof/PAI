<?php

set_include_path(get_include_path() . PATH_SEPARATOR . 'src');
spl_autoload_extensions('.php, .inc');
spl_autoload_register();

session_start();

use base\Router;
use controllers\DefaultController;
use controllers\ExerciseAPIController;
use controllers\MessageAPIController;
use controllers\SecurityController;
use controllers\StatsAPIController;

require_once "config.php";

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', DefaultController::class);
Router::get('dashboard', DefaultController::class);

Router::post('login', SecurityController::class);
Router::get('logout', SecurityController::class);
Router::post('register', SecurityController::class);

Router::post('messages', DefaultController::class);
Router::post('message_get', MessageAPIController::class);
Router::post('message_send', MessageAPIController::class);

Router::post('contact_list', MessageAPIController::class);
Router::post('contact_search', MessageAPIController::class);

Router::get('exercises', DefaultController::class);
Router::get('exercise_types_get', ExerciseAPIController::class);
Router::get('exercise_get', ExerciseAPIController::class);
Router::post('exercise_add', ExerciseAPIController::class);
Router::post('exercise_remove', ExerciseAPIController::class);

Router::get('stats_day', StatsAPIController::class);
Router::get('stats_month', StatsAPIController::class);

Router::run($path);