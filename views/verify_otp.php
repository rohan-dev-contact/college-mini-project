<?php
require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');
print($header);
session_start();
?>

<body>
  <?php
print($loginNav);
// echo($_SESSION["user_email_for_password_reset"]);
if(!isset($_SESSION["user_email_for_password_reset"])){
  // echo($_SESSION["user_email_for_password_reset"]);
  header("Location: login.php");
}
?>
  <div class="container">
    <div class="otp-verification-container">
      <h2 class="text-center">Verify OTP</h2>
      <form id="otpVerificationForm" action="reset_password.php" method="get">
        <div class="mb-3">
          <label for="otp" class="form-label">Enter OTP</label>
          <input type="text" class="form-control" id="otp" name="otp" required>
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary">Verify OTP</button>
        </div>
      </form>
    </div>
  </div>
  <?php print ($commonFooter)?>
</body>
</html>