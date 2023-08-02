<?php
$host = 'localhost';
$username  = 'root';
$password = '';
$database = 'pharmaco';



$conn =  new mysqli($host,$username,$password,$database);
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

?>