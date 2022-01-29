<?php

namespace repository;


use base\Session;
use PDO;
use repository\Repository;

class ExercisesRecordsRepository extends Repository
{

    public function exercise_add($exercise_id, $repeats, $weight, $date)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO exercises_records (user_id, exercise_id, repeats, weight,time) VALUES (:user,:exercise_id,:repeats,:weight,:date);
        ');


        $stmt->bindValue(':user', Session::getId(), PDO::PARAM_INT);
        $stmt->bindValue(':exercise_id', $exercise_id, PDO::PARAM_INT);
        $stmt->bindValue(':repeats', $repeats);
        $stmt->bindValue(':weight', $weight);
        $stmt->bindValue(':date', $date);

        $stmt->execute();
    }

    public function exercise_remove($id)
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM exercises_records WHERE id =:id and user_id = :user_id;
        ');
        $stmt->bindValue(':user_id', Session::getId(), PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function exercise_list($date): array
    {
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM exercises_records WHERE user_id = :user_id and time = :date;
        ");
        $stmt->bindValue(':user_id', Session::getId(), PDO::PARAM_INT);
        $stmt->bindValue(':date', $date);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result != false ? $result : [];
    }

    public function exercise_type_list(): array
    {
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM exercises order by title ASC;
        ");

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result != false ? $result : [];
    }

}