<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <title>REGISTER</title>
</head>

<body>
<div class="container">
    <div class="logo">
        <img src="public/img/logo.png">
    </div>
    <div class="login-container">
        <form class="register" action="register" method="POST">
            <div class="messages">
                <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="email" type="text" placeholder="email@email.com">
            <input name="password" type="password" placeholder="password">
            <input name="confirmedPassword" type="password" placeholder="confirm password">
            <input name="username" type="text" placeholder="username">
            <button type="submit">REGISTER</button>
            <a class="container-link" href="/login">Already have account</a>
        </form>

    </div>
</div>
</body>