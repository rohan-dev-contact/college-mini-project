<?php
// Include your database connection configuration
require('dbConnect.php');
$previousEmail ="";

// Start a session
session_start();
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
   
    if ($_SESSION["user_role"] == 'admin') {
        // $_SESSION["user_role"] = 'admin';
        header("Location: admin.php"); // Redirect admin to admin portal
    } else {
        header("Location: home.php"); // Redirect regular users to home page
    }
    // header("Location: home.php"); // Redirect to the home page
    exit();
}
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email =rtrim($_POST["email"]);
    $email =ltrim($email);
    $password = $_POST["password"];

    try {
        $sql = "SELECT id, password,role FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            // User exists and password matches, store user ID in session
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["logged_in"] = true;
            // Set success message for display
            $successMessage = "Login successful. Redirecting...";
            if ($user["role"] == 'admin') {
                $_SESSION["user_role"] = 'admin';
                header("Location: admin.php"); // Redirect admin to admin portal
            } else {
                header("Location: home.php"); // Redirect regular users to home page
            }
        } else {
            // User not found or password doesn't match, show error message
            $errorMessage = "Invalid credentials. Please try again.";
            $previousEmail =  (isset($email)==1) ? $email : "";
        }
    } catch (PDOException $e) {
        $errorMessage = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Include your head content here -->
</head>

<body>
    <?php
    require('../partials/header.php');
    require('../partials/navbar.php');
    require('../partials/footer.php');
    print($header);
    print($loginNav);
    ?>

    <div class="container">
        <div class="login-container">
            <h2 class="text-center">Login</h2>

            <!-- Display success or error message here -->
            <?php
        if (isset($errorMessage)) {
            echo '<div class="alert alert-danger alert-dismissible text-center" role="alert">';
            echo $errorMessage;
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
        ?>

            <form id="loginForm" action="login.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php  echo $previousEmail; ?> "  required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>

            <div class="text-start mt-3">
                <a href="../views/forgot_password.php">Forgot Password?</a> | New To Our Application <a href="../views/signup.php">Sign Up</a>
            </div>
        </div>
    </div>

    <?php
    print($commonFooter);
    ?>
</body>

</html>
