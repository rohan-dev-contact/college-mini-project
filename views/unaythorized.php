<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your stylesheet if you have one -->
</head>

<body>
    <div class="container">
        <div class="error-container">
            <h1 class="error-title">Unauthorized Access</h1>
            <p class="error-description">You do not have permission to access this page.</p>
            <?php
            // Check if the user is already logged in
            session_start();
            if (isset($_SESSION["user_id"])) {
                echo '<a class="btn btn-primary" href="logout.php">Logout</a>';
            } else {
                echo '<a class="btn btn-primary" href="login.php">Login</a>';
            }
            ?>
        </div>
    </div>
</body>

</html>
