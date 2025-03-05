<?php

    session_start();

    session_destroy();

    header("location:./controllerHome.php");

    exit;