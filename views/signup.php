<?php
// Include your database connection configuration
require('dbConnect.php');

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $userid = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);

    try {
        $sql_check = "SELECT id FROM users WHERE email = ?";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->execute([$email]);
        $existing_user = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
        if ($existing_user) {
            $errorMessage = "User with this email already exists. Please log in or use a different email.";
        } else {
          $sql = "INSERT INTO users (email, phone, password, name, userid) VALUES (?, ?, ?, ?, ?)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([$email, $phone, $password, $name, $userid]);

          // Insertion successful, show success message
          $successMessage = "Registration successful!";
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
        <div class="signup-container">
            <div class="span2 gap-2 mb-3">
                <a href="login.php" class="btn btn-secondary">Back to Login</a>
            </div>
            <h2 class="text-center">Sign Up</h2>

            <?php
            if (isset($errorMessage)) {
                echo '<div class="alert alert-danger alert-dismissible text-center" role="alert">';
                echo $errorMessage;
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            } elseif (isset($successMessage)) {
                echo '<div class="alert alert-success alert-dismissible text-center" role="alert">';
                echo $successMessage;
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            }
            ?>

            <form id="signupForm" action="signup.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                  <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                    <!-- <a href="login.php" class="btn btn-secondary">Back to Login</a> -->
                  </div>
            </form>
        </div>
    </div>

    <?php
    print($commonFooter);
    ?>
</body>

</html>
