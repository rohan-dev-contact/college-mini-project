<?php
require('dbConnect.php');
$email =$_POST['email'];
$name = $_POST['name'];
$address = $_POST['address'];
$phonenumber = $_POST['phno'];
$password = $_POST['psw'];
// echo "$email"
$query = "SELECT * FROM USER;";
$result = $conn->query($query);
while($row = $result -> fetch_assoc()){
    echo $row["id"];
}
header("Location: http://localhost/index.php");
?>

