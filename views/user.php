<?php
require('../middleware/protected_page.php');
require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');

print($header);
?>

<body>
    <?php print($commonNav); ?>

    <div class="container mt-4">
        <a href="home.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Home</a>
        <h2>Welcome, <?php echo $_SESSION["name"]; ?></h2>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Options</h5>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="previous_orders.php" class="btn btn-link" style="text-decoration: none; font-size: 1rem;">View Completed Orders</a>
                    </li>
                    <li class="list-group-item">
                        <a href="current_orders.php" class="btn btn-link" style="text-decoration: none; font-size: 1rem;">View Active Orders</a>
                    </li>
                    <li class="list-group-item">
                        <a href="address_book.php" class="btn btn-link" style="text-decoration: none; font-size: 1rem;">Manage Address Book</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <?php print($commonFooter) ?>
</body>
</html>
