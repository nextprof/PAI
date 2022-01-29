const exercise_add_form = document.getElementsByClassName("exercise-form")[0];
const exercise_weight = document.getElementById("exercise-weight");
const exercise_id = document.getElementById("exercise-id");
const exercises_list_title = document.getElementsByClassName("exercise-title")[0];
const exercises_list = document.getElementsByClassName("exercises-list")[0];
let exercise_dict = {};

let day_diff = 0;
let date;

function next_day() {
    if (day_diff > 0) {
        day_diff--;
        get_exercises()
    }
}

function previous_day() {
    day_diff++;
    get_exercises();
}


function get_exercise_type_list() {
    fetch("/exercise_types_get", {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        },
    }).then(function (response) {
        return response.json();
    }).then(function (exercises) {
        exercises.forEach(
            element => {
                exercise_dict[element.id] = element;
            }
        )
        get_exercises()
    })
}


function remove_exercise(id) {
    let data = {
        'exercise_id': id
    }
    fetch("/exercise_remove", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (result) {
        get_exercises()
    })
}

function add_exercise_entry(id, title, repeats, weight) {
    let item = document.createElement("div")
    item.classList.add("exercise-entry")
    item.innerHTML = `<div class='name'>${title}</div>
                      <div class='repeats'>${repeats}</div>
                      <div class='weight'>${weight}</div>`

    let item_button_remove = document.createElement("button");
    item_button_remove.classList.add("exercise-remove");
    item_button_remove.innerHTML = "<i class=\"fas fa-times-circle\"></i>";
    item_button_remove.addEventListener("click", function () {
        remove_exercise(id);
    })

    exercises_list.appendChild(item)
    item.appendChild(item_button_remove);

}

function clean_exercise_list() {
    exercises_list.innerHTML = `
     <div class="exercise-entry">
        <div class="name"> Title</div>
        <div class="repeats">Repeats</div>
        <div class="weight">Weight</div>
     </div>`;
}


function add_exercise() {
    let data_form = new FormData(exercise_add_form);
    data_form.append("date", date.toISOString().split('T')[0])
    let json = JSON.stringify(Object.fromEntries(data_form.entries()))

    fetch("/exercise_add", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: json
    }).then(function (response) {
        return response.json();
    }).then(function (result) {
        get_exercises()

    })
}

const predefined_day_texts = {
    0: "Today",
    1: "Yesterday",
    2: "2 Days Ago",
    3: "3 Days Ago"
}


function get_exercises() {
    clean_exercise_list();
    date = new Date();
    date.setDate(date.getDate() - day_diff);

    if (day_diff in predefined_day_texts) {
        exercises_list_title.innerText = predefined_day_texts[day_diff]
    } else {
        exercises_list_title.innerText = `${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()}`
    }


    let date_string = date.toISOString().split('T')[0]
    fetch("/exercise_get?date=" + date_string, {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        },
    }).then(function (response) {
        return response.json();
    }).then(function (exercises) {
        load_exercises(exercises)
    })
}

function load_exercises(exercises) {
    exercises.forEach(item => {
            add_exercise_entry(
                item['id'],
                exercise_dict[item['exercise_id']].title,
                item['repeats'],
                item['weight'] == null || item['weight'] === '0' ? "-" : item['weight']
            )
        }
    )
}

window.addEventListener("load", function () {
    get_exercise_type_list();
    if (exercise_add_form !== null) {
        exercise_add_form.addEventListener("submit", async function (e) {
            e.preventDefault(); // before the code
            /* do what you want with the form */
            add_exercise(exercise_add_form);
        })
    }
});


function checkWeighted() {
    if (exercise_id.value > 0) {
        if (exercise_dict[exercise_id.value]['with_load']) {
            exercise_weight.disabled = false;
        } else {
            exercise_weight.disabled = true;
            exercise_weight.value = 0;
        }
    }
}