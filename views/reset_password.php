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
          <label for="newPassword" class="form-label">Enter New Password</label>
          <input type="password" class="form-control" id="newPassword" name="newPassword" required>
        </div>
        <input type="hidden" name="otp" value="<?php echo $_GET['otp']; ?>">
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary">Update Password</button>
        </div>
      </form>
    </div>
  </div>
  <?php print ($commonFooter)?>
</body>
</html>
