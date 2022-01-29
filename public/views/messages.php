<?php
include "header.php";
?>

    <script src="public/js/messages.js" defer></script>
    <div class="chat">

        <div class="message-box">
            <div class="message-title"></div>
            <div class="message-list">

            </div>

            <form class="message-form">
                <input class="message-input" type="textarea">
            </form>
        </div>
        <div class="contact-box">
            <div class="title-line">Contacts</div>
            <div class="contact-list">
            </div>

            <div class="title-line">Find Friend</div>
            <div class="search-box">

                <form class="contact-search-form">
                    <input class="contact-query" type="text" placeholder="Searched username">
                </form>
                <div class="search-list">
                </div>
            </div>

        </div>


    </div>


<?php
include "footer.php";
?>