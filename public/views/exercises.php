<?php
include "header.php";
?>
    <script src="public/js/exercises.js" defer></script>

    <div class="exercises">
        <div class="header">
            <button onclick="previous_day()"><i class="fas fa-arrow-left"></i></button>
            <div class="exercise-title">DAY</div>
            <button onclick="next_day()"><i class="fas fa-arrow-right"></i></button>
        </div>

        <div class="add-box">
            <div class="headers">
                <label for="exercise-id">Name:</label>
                <label for="exercise-series">Series:</label>
                <label for="exercise-repeats">Repeats:</label>
                <label for="exercise-weight">Weight:</label>
                <label for="exercise-weight"></label>
            </div>
            <form id="exercise-form" class="exercise-form">
                <select name="exercise-id" id="exercise-id" onchange="checkWeighted()" required>
                    <option value="">--Choose exercise--</option>
                    <?php

                    foreach ($exercises as $type) {
                        echo "         <option value=" . $type['id'] . ">" . $type['title'] . "</option>";
                    }
                    ?>
                </select>

                <input name="exercise-series" id="exercise-series" type="number" min="1" placeholder="Series: 20"
                       required>

                <input name="exercise-repeats" id="exercise-repeats" type="number" min="1"
                       placeholder="Repeats per series: 20"
                       required>


                <input name="exercise-weight" id="exercise-weight" type="number" min="null"
                       placeholder="Weight in kilos: 20kg">

                <!--                <input name="submit" id="exercise-id" type="submit" value="">-->
                <button id="add" type="submit" class="add-exercise"><i class='fas fa-plus-circle'></i></button>
            </form>
        </div>
        <div class="exercises-list">
            <div class="exercise-entry">
                <div class="name">
                    Title
                </div>
                <div class="repeats">
                    Repeats
                </div>
                <div class="weight">
                    Weight
                </div>
            </div>

        </div>

    </div>

<?php
include "footer.php";
?>