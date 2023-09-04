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
    <p class="text-center">Select Any Option</p>
    <div class="row mt-3">
        <div class="col-md-3 mb-4">
            <a href="manage_user.php" class="card-link text-decoration-none">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Manage User <i class="bi bi-people-fill"></i></h5>
                        <!-- <p class="card-text">View and update medicine stock.</p> -->
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="manage_stock.php" class="card-link text-decoration-none">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Stock Management <i class="bi bi-capsule"></i></h5>
                        <!-- <p class="card-text">Add new medicines to the stock.</p> -->
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="list_contact_us_messages.php" class="card-link text-decoration-none">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center ">Messages <i class="bi bi-chat-left-text"></i></h5>
                        <!-- <p class="card-text">See messages sent by user</p> -->
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="admin_orders.php" class="card-link text-decoration-none">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center ">Orders <i class="bi bi-card-list"></i></h5>
                        <!-- <p class="card-text">See messages sent by user</p> -->
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="admin_orders_processed.php" class="card-link text-decoration-none">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center ">Processed Orders <i class="bi bi-card-list"></i></h5>
                        <!-- <p class="card-text">See messages sent by user</p> -->
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
