<?php
require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');
print($header);
?>

<body>
  <?php
print($loginNav);
?>
  <div class="container">
    <div class="otp-verification-container">
      <h2 class="text-center">Verify OTP</h2>
      <form id="otpVerificationForm" action="validate_otp.php" method="post">
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