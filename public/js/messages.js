let chat_title = document.getElementsByClassName("message-title")[0];
let chat_list = document.getElementsByClassName("message-list")[0];


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


document.addEventListener('DOMContentLoaded', function () {
    create_message("siema od byka1", false);
    create_message("siema od byka2", true);
    create_message("siema od byka3", false);
}, false);