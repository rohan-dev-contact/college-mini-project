<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Sign Up</title>
</head>
<body>
<form class='signupform' id="loginForm" action="singUpHandler.php" method="post">
        <div class="container">
            <h2>Sign Up</h2>
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
            <!-- <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label> -->
            <a href="http://localhost/index.php" style="text-decoration: none;"><p>Go Back to Login </p></a>
            
        </div>
    </form>
</body>
</html>