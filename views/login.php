<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require('../phpMailer/src/Exception.php');
require('../phpMailer/src/PHPMailer.php');
require('../phpMailer/src/SMTP.php');
try{


// Include your database connection configuration
require('dbConnect.php');
$previousEmail = "";

// Start a session
session_start();
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true && isset($_SESSION["otp_verified"]) && $_SESSION["otp_verified"] === true ) {
    if ($_SESSION["user_role"] == 'admin') {
        header("Location: admin.php"); // Redirect admin to admin portal
    } else {
        header("Location: home.php"); // Redirect regular users to home page
    }
    exit();
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify reCAPTCHA
    $recaptchaSecretKey = '6LcAMVAoAAAAAGuI3Rde7W_t1y3_ZVDkzu9Es4OG'; // Replace with your Secret Key
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        // CAPTCHA verification failed
        $errorMessage = "CAPTCHA verification failed. Please try again.";
    } else {
        // CAPTCHA verification passed, continue with your login logic
        $email = rtrim($_POST["email"]);
        $email = ltrim($email);
        $password = $_POST["password"];

        try {
            $sql = "SELECT id, password, role, name FROM users WHERE email = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            function generateOTP() {
                $otp = rand(100000, 999999); // Generate a 6-digit OTP
                return strval($otp);
            }
            if ($user && password_verify($password, $user["password"])) {
                // User exists and password matches, store user ID in session
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["name"] = $user["name"];
                $_SESSION["logged_in"] = true;
                $_SESSION["otp_verified"] = false;
                $_SESSION["user_email"] = $email; // Store the user's email for OTP validation
                $_SESSION["role"] = $user["role"];
            
                // Generate an OTP
                $otp = generateOTP();
            
                // Store the OTP in the database
                date_default_timezone_set('Asia/Kolkata'); // Set the timezone to Asia/Kolkata (India)
                $expirationTime = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP expiration time
                $query = "INSERT INTO user_otp (user_email, otp, expiration_time) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$email, $otp, $expirationTime]);
            
                // Send the OTP to the user's email
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'rohan19mondal@gmail.com'; // Your Gmail email address
                $mail->Password = 'ngmagrvmzllruskq';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
            
                // $mail->setFrom('your@gmail.com', 'Your Name'); // Replace with your Gmail email and name
                $mail->addAddress($email, $user["name"]); // Recipient's email and name
                $mail->Subject = 'Your OTP for Login';
                $mail->Body = 'Your OTP is: ' . $otp;
            
                if ($mail->send()) {
                    // Email sent successfully
                    header("Location: otp_validation.php"); // Redirect to OTP validation page
                } else {
                    // Email could not be sent
                    $errorMessage = "Failed to send the OTP. Please try again.";
                }
            } else {
                // User not found or password doesn't match, show error message
                $errorMessage = "Invalid credentials. Please try again.";
                $previousEmail = (isset($email) == 1) ? $email : "";
            }
        } catch (PDOException $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    }
}
}catch(\Throwable $th){

}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Include your head content here -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <?php
    try {
        require('../partials/header.php');
        require('../partials/navbar.php');
        require('../partials/footer.php');
        print($header);
        print($loginNav);
    } catch (\Throwable $th) {
        //throw $th;
    }
   
    ?>

    <div class="container-fluid m-2">
        <div class="login-container">
            <h2 class="text-center">Login</h2>

            <!-- Display success or error message here -->
            <?php
            try {
                if (isset($errorMessage)) {
                    echo '<div class="alert alert-danger alert-dismissible text-center" role="alert">';
                    echo $errorMessage;
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
           
            ?>

            <form id="loginForm" action="login.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $previousEmail; ?> " required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="g-recaptcha mb-3" data-sitekey="6LcAMVAoAAAAALeqOp39UH3zSkz_Y3gNJsJeXBvT"></div> <!-- Replace with your Site Key -->
                <div class="d-grid gap-2">
                    <button id ="login-button" type="submit" class="btn btn-primary">Login <i class="bi bi-arrow-right"></i></button>
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
