<?php
require('../middleware/protected_page.php');

// Check user's role before allowing access
if ($_SESSION["user_role"] !== 'admin') {
    // User does not have admin role, redirect or show an error
    header("Location: unauthorized.php"); // You can create an unauthorized page
    exit();
}

require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');

print($header);
?>
<body>
    <?php
    print($adminNav);
    ?>  
    <div class="container mt-5">
    <h1 class="text-center">Admin Panel</h1>
    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <a href="manage_user.php" class="card-link text-decoration-none">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage User</h5>
                        <p class="card-text">View and update medicine stock.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="manage_stock.php" class="card-link text-decoration-none">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Medicine</h5>
                        <p class="card-text">Add new medicines to the stock.</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- Add more cards for other functionalities -->
    </div>
</div>
    <?php print ($commonFooter)?>
    </body>
    </html>
