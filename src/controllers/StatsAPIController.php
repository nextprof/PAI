<?php

namespace controllers;

use repository\StatsRepository;

class StatsAPIController extends APIController
{
    public function stats_day()
    {
        $day = $_GET['date'];
        return self::JSONResponse((new StatsRepository())->getDailyStats($day));
    }

    public function stats_month()
    {
        $month = $_GET['date'];
        return self::JSONResponse((new StatsRepository())->getMonthlyStats($month));
    }
}