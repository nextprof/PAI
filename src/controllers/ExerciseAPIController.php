<?php

namespace controllers;


use repository\ExercisesRecordsRepository;

class ExerciseAPIController extends APIController
{

    public function exercise_get(): string
    {
        $date = $_GET['date'];
        return self::JSONResponse((new ExercisesRecordsRepository())->exercise_list($date));
    }

    public function exercise_add(): string
    {
        if ($this->isPost()) {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $exercise_id = $decoded['exercise-id'];
            $repeats = intval($decoded['exercise-repeats']);
            $series = intval($decoded['exercise-series']);


            $weight = $decoded['exercise-weight'] ?? "0";
            $date = $decoded['date'];

            (new ExercisesRecordsRepository)->exercise_add($exercise_id, $repeats * $series, $weight, $date);
            return self::JSONResponse(["response" => "ok"]);
        } else {
            return self::JSONResponse(["response" => "need to be post method"]);
        }
    }

    public function exercise_remove(): string
    {
        if ($this->isPost()) {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $exercise_id = $decoded['exercise_id'];

            (new ExercisesRecordsRepository)->exercise_remove($exercise_id);
            return self::JSONResponse(["response" => "ok"]);
        } else {
            return self::JSONResponse(["response" => "need to be post method"]);
        }
    }

    public function exercise_types_get(): string
    {
        return self::JSONResponse((new ExercisesRecordsRepository())->exercise_type_list());
    }
}