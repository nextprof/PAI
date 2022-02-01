let chat_title = document.getElementsByClassName("message-title")[0];
let chat_list = document.getElementsByClassName("message-list")[0];
let contact_list = document.getElementsByClassName("contact-list")[0];
let chat_input = document.getElementsByClassName("message-input")[0];
let chat_form = document.getElementsByClassName("message-form")[0];
let recipient_id = null;
let recipient_name = null;

let contact_search_form = document.getElementsByClassName("contact-search-form")[0];
let contact_search_input = document.getElementsByClassName("contact-query")[0];
let contact_search_list = document.getElementsByClassName("search-list")[0];

function getUserId() {
    return parseInt(getCookie("user_id"));
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function clean_messages() {
    chat_list.innerHTML = "";
    chat_title.innerHTML = "";
}

function load_message_list(messages) {
    for (let message_id in messages) {
        console.log(messages[message_id])
        console.log(messages[message_id]['id_from'] + " vs " + getUserId())
        if (parseInt(messages[message_id]['id_from']) === getUserId()) {
            create_message(messages[message_id]['message'], true);
        } else {
            create_message(messages[message_id]['message'], false);
        }
    }
}

function get_messages(id) {
    fetch("/message_get?id=" + id, {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(function (response) {
        return response.json();
    }).then(function (messages) {
        clean_messages();
        chat_title.innerHTML = recipient_name;
        load_message_list(messages);
    })
}

function create_message(message, its_me = false) {
    let element = document.createElement("div")
    element.innerHTML = message;
    element.classList.add("message")
    if (its_me) {
        element.classList.add("to")
    } else {
        element.classList.add("from")
    }
    chat_list.appendChild(element);
}


function add_contact(id, name) {
    let element = document.createElement("button")
    element.innerHTML = "<i class=\"fas fa-user\"></i>" + name;
    element.classList.add("user")
    element.classList.add("message-user")
    element.addEventListener("click", function () {
        recipient_id = id;
        recipient_name = name;
        get_messages(id);
    })
    contact_list.appendChild(element);
}

let global_contacts = {};

function get_contact_list() {

    fetch("/contact_list", {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(function (response) {
        return response.json();
    }).then(function (contacts) {

        global_contacts = {};
        contacts.forEach(contact => {
                global_contacts[contact['id']] = contact
            }
        );

        load_contact_list();
    })
}

function load_contact_list() {
    contact_list.innerHTML = "";

    console.log(global_contacts)

    for (let key in global_contacts) {
        add_contact(global_contacts[key]['id'], global_contacts[key]['name'])
    }
}

document.addEventListener('DOMContentLoaded', function () {
    get_contact_list()
}, false);


function send_message(textContent) {
    console.log(recipient_id)
    const data = {
        message: textContent,
        id: recipient_id
    };

    fetch("/message_send", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (result) {
        get_messages(recipient_id)
    })
}

function add_search_contact(id, name) {
    let element = document.createElement("button")
    element.innerHTML = "<i class=\"fas fa-plus add-symbol\"></i>" + name;
    element.classList.add("user")
    element.classList.add("add-user")
    element.addEventListener("click", function () {
        recipient_id = id;
        recipient_name = name;
        send_message("👋");
        get_contact_list();
        get_messages(id);
        contact_search_list.innerHTML = "";
    })
    contact_search_list.appendChild(element);
}

function load_search_contact_list(contacts) {
    console.log(global_contacts)
    contacts.forEach(contact => {
        if(!(contact['id'] in global_contacts))
            add_search_contact(contact['id'], contact['name']);
    });

}

function search_users(value) {
    const data = {
        query: value,
    };
    fetch("/contact_search", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (contacts) {
        load_search_contact_list(contacts)
    })
}

window.addEventListener("load", function () {
    if (chat_form !== null) {
        chat_form.addEventListener("submit", async function (e) {
            e.preventDefault();

            send_message(chat_input.value);
            chat_input.value = "";
        })
    }

    if (contact_search_form !== null) {
        contact_search_form.addEventListener("submit", async function (e) {
            e.preventDefault();

            contact_search_list.innerHTML = "";
            search_users(contact_search_input.value);
        })
    }

});

window.setInterval(function () {
    get_contact_list();
    if (recipient_id != null)
        get_messages(recipient_id);
}, 5000);