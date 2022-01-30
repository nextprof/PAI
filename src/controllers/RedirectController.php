<?php

namespace controllers;

class RedirectController
{
    public static function Redirect(string $url = "/", string $message = "Redirecting")
    {
        return "
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta http-equiv='refresh' content='2;url=" . $url . "'>
    </head>
<style>
html{
background-color: #2b2b2d;
padding: 2rem;
text-align: center;
color: white;
}

img{
    width: 50%;
    max-width: 256px;
}
    
</style>
    <body>
    <img src='/public/img/logo.png'>
    <h1>" . $message . "</h1>
    </body>
</html>";
    }
}