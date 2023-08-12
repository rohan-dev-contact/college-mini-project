<?php

// echo($_SESSION["logged_in"]);
session_start();
if ($_SESSION["logged_in"] != 1) {
    // Redirect to the login page if not logged in
    header("Location: ../views/login.php");
    exit;
}


// Rest of your page content
?>
