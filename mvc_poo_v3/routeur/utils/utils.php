<?php 

    //Creation de la fonction connect()
    function connect() {
        return new PDO('mysql:host=localhost;dbname=users2', $_ENV['login'], '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    function sanitize($data) {
        return htmlentities(strip_tags(stripslashes(trim($data))));
    }