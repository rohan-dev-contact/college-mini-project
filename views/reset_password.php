<?php
require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');
print($header);
session_start();
?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const passwordInput = document.getElementById("password");
        const passwordMessage = document.getElementById("password-message");

        passwordInput.addEventListener("input", function () {
            const password = passwordInput.value;
            const strongPasswordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;

            if (strongPasswordRegex.test(password)) {
                passwordMessage.textContent = "Password is valid";
                passwordMessage.style.color = "green";
            } else {
                passwordMessage.textContent = "Password should contain at least 8 characters, including uppercase, lowercase, and numbers.";
                passwordMessage.style.color = "red";
            }
        });
    });
    function validatePassword() {
        const passwordInput = document.getElementById("password");
        const passwordMessage = document.getElementById("password-message");

        const password = passwordInput.value;
        const strongPasswordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;

        if (strongPasswordRegex.test(password)) {
            passwordMessage.textContent = "Password is valid";
            passwordMessage.style.color = "green";
            return true;
        } else {
            passwordMessage.textContent = "Password should contain at least 8 characters, including uppercase, lowercase, and numbers.";
            passwordMessage.style.color = "red";
            return false;
        }
    }

    function handleSubmit() {
        if (validatePassword()) {
            document.getElementById("resetPasswordForm").submit();
        }
    }
</script>
<body>
  <?php
  print($loginNav);
  // Ensure the user_email_for_password_reset is set in the session
  if (!isset($_SESSION["user_email_for_password_reset"])) {
    header("Location: login.php");
  }
  ?>
  <div class="container">
    <div class="otp-verification-container">
      <h2 class="text-center">Reset Password</h2>
      <form id="resetPasswordForm" action="resetPasswordProcess.php" method="post">
      <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="newPassword" required>
                        <small id="password-message" class="form-text"></small>
                    </div>
        <input type="hidden" name="otp" value="<?php echo $_GET['otp']; ?>">
        <div class="d-grid gap-2">
        <button type="button" class="btn btn-primary" onclick="handleSubmit()">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <?php print ($commonFooter)?>
</body>
</html>
