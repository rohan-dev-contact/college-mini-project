<?php
require('dbConnect.php');
$email =$_POST['email'];
$name = $_POST['name'];
$address = $_POST['address'];
$phonenumber = $_POST['phno'];
$password = $_POST['psw'];
$values = [$name,$email,$address,$phonenumber,$password];
$sqlConnection = $conn;

try {
    $RawQuery = "INSERT INTO user (name,email,address,phno,psw) VALUES (?,?,?,?,?);";
    $statement = $sqlConnection->prepare($RawQuery);
    $statement->execute($values);
    header("Location: http://localhost/login.php");
} catch (\Throwable $th) {
    header("Location: http://localhost/signup.php?error=".$th->getMessage()."?email=$email&name=$name&address=$address&phno=$phonenumber&psw=$password");
}

?>

