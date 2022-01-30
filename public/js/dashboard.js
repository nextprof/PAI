let stat_title_month = document.getElementsByClassName("title-month")[0];
let stat_title_day = document.getElementsByClassName("title-day")[0];

let stat_canvas_month = document.getElementById("chart-month");
let stat_canvas_day = document.getElementById("chart-day");

let day_diff = 0;
let month_diff = 0;


function next_day() {
    if (day_diff > 0) {
        day_diff--;
        refresh_daily();
    }
}

function previous_day() {
    day_diff++;
    refresh_daily();
}

function next_month() {
    if (month_diff > 0) {
        month_diff--;
        refresh_monthly();
    }
}

function previous_month() {
    month_diff++;
    refresh_monthly();
}


function generate_colors(count) {
    let colors = [];
    while (colors.length < count) {
        let color;
        do {
            color = Math.floor((Math.random() * 1000000) + 1);
        } while (colors.indexOf(color) >= 0);
        colors.push("#" + ("000000" + color.toString(16)).slice(-6));
    }
    return colors;
}

function fetch_daily_stats(day) {
    let date_string = day.toISOString().split('T')[0]
    console.log(date_string)
    return fetch("/stats_day?date=" + date_string, {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        },
    }).then(function (response) {
        return response.json();
    }).then(function (exercises) {
        return exercises
    })
}

function fetch_monthly_stats(month) {
    let date_string = month.toISOString().split('T')[0]
    console.log(date_string)
    return fetch("/stats_month?date=" + date_string, {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        },
    }).then(function (response) {
        return response.json();
    }).then(function (exercises) {
        return exercises
    })
}

const predefined_day_texts = {
    0: "Today",
    1: "Yesterday",
    2: "2 Days Ago",
    3: "3 Days Ago"
}

const predefined_month_texts = {
    0: "This Month",
    1: "Previous Month",
    2: "2 Months Ago",
    3: "3 Months Ago"
}

function refresh_daily() {
    let day = new Date();
    day.setDate(day.getDate() - day_diff);


    if (day_diff in predefined_day_texts) {
        stat_title_day.innerText = predefined_day_texts[day_diff]
    } else {
        stat_title_day.innerText = `${day.getDate()}-${day.getMonth() + 1}-${day.getFullYear()}`
    }

    fetch_daily_stats(day).then(data => update_chart(stat_canvas_day, data));
}

function refresh_monthly() {
    let month = new Date();
    month.setMonth(month.getMonth() - month_diff);


    if (month_diff in predefined_month_texts) {
        stat_title_month.innerText = predefined_month_texts[month_diff]
    } else {
        stat_title_month.innerText = `${month.getMonth() + 1}-${month.getFullYear()}`
    }


    fetch_monthly_stats(month).then(data => update_chart(stat_canvas_month, data));
}


window.addEventListener("load", function () {
    refresh_daily();
    refresh_monthly()
});

function update_chart(root, data) {
    root.innerHTML = "";

    let labels = []
    let images = []
    let values = []

    data.forEach(user => {
        labels.push(user['username'])
        images.push(user['image_url'])
        values.push(user['sum'])
    })


    let element = document.createElement("canvas")

    root.appendChild(element);

    return new Chart(element, {
        type: "bar",
        plugins: [{
            afterDraw: chart => {
                var ctx = chart.chart.ctx;
                var xAxis = chart.scales['x-axis-0'];
                var yAxis = chart.scales['y-axis-0'];
                xAxis.ticks.forEach((value, index) => {
                    var x = xAxis.getPixelForTick(index);
                    var y = yAxis.getPixelForValue(values[index]);

                    var image = new Image();
                    image.src = images[index];
                    ctx.drawImage(image, x - 32, y - 32);
                });
            }
        }],
        data: {
            labels: labels,
            datasets: [{
                label: 'Users',
                data: values,
                backgroundColor: generate_colors(32),
            }]
        },
        options: {
            responsive: true,
            layout: {
                padding: {
                    top: 64,
                    left: 4,
                    right: 4,
                    bottom: 4,
                }
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    ticks: {
                        padding: 4
                    }
                }],
            },
            tooltips: {enabled: false},
        }
    });
}

