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
  <div class="container-fliud m-2">
    <div class="email-container">
      <h2 class="text-center">Forgot Password</h2>
      <form id="emailForm" action="../service/send_otp.php" method="post">
        <div class="mb-3">
          <label for="email" class="form-label">Enter Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary">Send OTP</button>
        </div>
      </form>
    </div>
  </div>
  <?php print ($commonFooter)?>
</body>
</html>