<?php
    session_start();
    if(isset($_SESSION["auth"])){
        // session_unset();
        $_SESSION = array();
        session_destroy();
        // Logged out, return home.
        Header("Location: login.php");
    } else {
        Header("Location: login.php");
    }
?>