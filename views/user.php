<?php
require('../middleware/protected_page.php');

require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');
// session_start();
print($header);
?>

<body>
    <?php
    print($commonNav);
    ?>

    <div class="container">
    <a href="home.php"class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
        <h2><?php print_r($_SESSION["name"]);?></h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Options</h5>
                <ul class="list-group">
                    <li class="list-group-item"><a style="text-decoration: none;" href="previous_orders.php">View Complete Orders</a></li>
                    <li class="list-group-item"><a style="text-decoration: none;" href="current_orders.php">View Active Orders</a></li>
                    <li class="list-group-item"><a style="text-decoration: none;" href="address_book.php">Manage Address Book</a></li>
                </ul>
            </div>
        </div>
    </div>
    <?php print ($commonFooter)?>
</body>

</html>