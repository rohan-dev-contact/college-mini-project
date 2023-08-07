<?php
require('header.php');
print($header);
if(isset($_GET['email'])){
 $email =$_GET['email']; 
$name = $_GET['name'];
$address = $_GET['address'];
$phonenumber = $_GET['phno'];
$password = $_GET['psw'];
}
?>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php">PharmaCo</a>
</div>
</nav>
<form class='signupform' id="loginForm" action="singUpHandler.php" method="post">
        <div class="container">
            <h4>Sign Up</h4>
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" required>
            
            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" required>
            
            <label for="address"><b>Address</b></label>
            <input type="text" placeholder="Enter Address" name="address" required>

            <label for="phno"><b>Phone Number</b></label>
            <input type="text" placeholder="Enter Phone Number" name="phno" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit">SingUp</button>
            <a href="http://localhost/login.php" style="text-decoration: none;"><p>Go Back to Login </p></a>
            
        </div>
    </form>
</body>
</html>