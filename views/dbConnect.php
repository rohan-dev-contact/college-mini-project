<?php
$host = 'db4free.net';
$username  = 'pharmyland';
$password = 'pharmyland';
// $host = 'localhost';
// $username  = 'pharmaCo';
// $password = '';
$database = 'pharmyland';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>