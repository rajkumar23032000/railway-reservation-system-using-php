<?php 
    include_once("config.php");
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
    header("Location: signin.html");
?>