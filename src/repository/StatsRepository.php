<?php

namespace repository;

use base\Session;
use PDO;

class StatsRepository extends Repository
{


    public function getDailyStats($date): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id as user_id, sum_day as time_day, score_day as sum, image_url, username
            FROM v_user_scores_daily 
                join users u on u.id = v_user_scores_daily.user_id
                join (select user_id from v_user_contact_list(:user_id) union select (:user_id)) as t on id = t.user_id
            where sum_day = :date;
        ');
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':user_id', Session::getId());
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getMonthlyStats($date): array
    {
        $stmt = $this->database->connect()->prepare("
            SELECT u.id as user_id, time as time_month, sum_month as sum , image_url , username
            FROM v_user_scores_monthly 
                join users u on u.id = v_user_scores_monthly.user_id
                join (select user_id from v_user_contact_list(:user_id) union select (:user_id)) as t on id = t.user_id
            where time = date_trunc('month',TO_TIMESTAMP(:date,'YYYY-MM-DD'));
        ");
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':user_id', Session::getId());
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}