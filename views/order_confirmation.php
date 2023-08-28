<?php 
require('../middleware/protected_page.php');
require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');

print($header);
?>

<body>
    <?php
    print($commonNav);?>
    <div class="container-fluid m-2">
        <div class="gap-2 m-3 d-inline">
            <a href="cart.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
            <p class="text-center fs-2 fw-bold">Medicine bag</p>
        </div>
        <div class="alert alert-success" role="alert">
            Your order has been placed successfully! Thank you for shopping with us.
        </div>

    </div>
    <?php print ($commonFooter)?>
</body>

</html>