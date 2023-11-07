<?php
require('../middleware/protected_page.php');

// Check user's role before allowing access
if ($_SESSION["user_role"] !== 'admin') {
    // User does not have an admin role, redirect or show an error
    header("Location: unauthorized.php"); // You can create an unauthorized page
    exit();
}

require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');

print($header);
?>

<style>
    .my-class-to-b {
        margin-bottom: 50px;
    }
</style>

<body>
    <?php
    print($commonNav); // Use the common navigation bar
    ?>

    <div class="container mt-3 my-class-to-b">
        <div class="gap-2 mb-3 d-inline">
            <a href="manage_stock.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Medicine List</a>
            <p class="text-center fs-4 fw-bold">Add Stock</p>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                <form method="post" action="process_add_stock.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="medicine_name" class="form-label">Medicine Name</label>
                        <input type="text" class="form-control" id="medicine_name" name="medicine_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" class="form-control" id "unit" name="unit" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="expiration_date" class="form-label">Expiration Date</label>
                        <input type="date" class="form-control" id="expiration_date" name="expiration_date">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Stock</button>
                </form>
            </div>
        </div>
    </div>

    <?php print ($commonFooter)?>
</body>

</html>
