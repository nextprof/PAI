<?php
include "header.php";
?>
    <script src="public/js/dashboard.js" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <h1>Dashboard</h1>

    <div class="stat-box daily">
        <div class="header">
            <button onclick="previous_day()"><i class="fas fa-arrow-left"></i></button>
            <div class="title"><h2 class="title-day">Some Day</h2></div>
            <button onclick="next_day()"><i class="fas fa-arrow-right"></i></button>
        </div>
        <div id="chart-day" class="chart-box">
        </div>
    </div>


    <div class="stat-box monthly">
        <div class="header">
            <button onclick="previous_month()"><i class="fas fa-arrow-left"></i></button>
            <div class="title"><h2 class="title-month">Some Month</h2></div>
            <button onclick="next_month()"><i class="fas fa-arrow-right"></i></button>
        </div>
        <div id="chart-month" class="chart-box">
        </div>
    </div>

<?php
include "footer.php";
?>