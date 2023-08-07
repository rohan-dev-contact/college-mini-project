<?php
require('dbConnect.php');
$userName =  $_POST["uname"];
$password = $_POST["psw"];
echo "working";
header("Location: http://localhost/home.php");
?>