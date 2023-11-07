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

<style>
    .my-class-to-b {
        margin-bottom: 50px;
    }
</style>

<body>
    <?php
    print($commonNav); // Use the common navigation bar
    ?>

    <div class="container mt-5 my-class-to-b">
        <div class="gap-2 mb-3 d-inline">
            <a href="admin.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>
            <a href="add_medicine.php" class="btn btn-outline-primary">Add Medicine</a>
            <p class="text-center fs-4 fw-bold">Manage Stocks</p>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <form class="mb-3" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search medicine..." style="font-size: 0.9rem;" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button class="btn btn-outline-primary" type="submit" style="font-size: 0.9rem;"><i class="bi bi-search"></i></button>
                        <button type= "button" class="btn btn-outline-secondary" onclick="clearSearch()" style="font-size: 0.9rem;">Clear</button>
                    </div>
                </form>

                <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Medicine Name</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Expiration Date</th>
                                <th>Notes</th>
                                <th>Image</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Include your database connection configuration
                            require('dbConnect.php');

                            // Handle search query
                            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

                            // Fetch stock items from the database based on search query
                            $sql = "SELECT id, medicine_name, quantity, unit, price, expiration_date, notes, image FROM stock
                                    WHERE medicine_name LIKE :searchTerm and isDeleted = 0";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
                            $stmt->execute();
                            $stockItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($stockItems as $item) {
                                echo '<tr>';
                                echo '<form method="post" action="update_stock.php" enctype="multipart/form-data">';
                                echo '<input type="hidden" name="item_id" value="' . $item['id'] . '">';
                                echo '<td><input type="text" class="form-control" name="medicine_name" value="' . $item['medicine_name'] . '" style="font-size: 0.9rem;"></td>';
                                echo '<td><input type="number" class="form-control" name="quantity" value="' . $item['quantity'] . '" style="font-size: 0.9rem;"></td>';
                                echo '<td><input type="text" class="form-control" name="unit" value="' . $item['unit'] . '" style="font-size: 0.9rem;"></td>';
                                echo '<td><input type="text" class="form-control" name="price" value="' . $item['price'] . '" style="font-size: 0.9rem;"></td>';
                                echo '<td><input type="date" class="form-control" name="expiration_date" value="' . $item['expiration_date'] . '" style="font-size: 0.9rem;"></td>';
                                echo '<td><input type="text" class="form-control" name="notes" value="' . $item['notes'] . '" style="font-size: 0.9rem;"></td>';
                                // echo '<td><img src="data:image/jpeg;base64,' . base64_encode($item['image']) . '" alt="Image" style="max-width: 60px; object-fit: contain;"></td>';
                                if (!empty($item['image'])) {
                                    echo '<td><img src="data:image/jpeg;base64,' . base64_encode($item['image']) . '" alt="Image" style="max-width: 60px; object-fit: contain;"></td>';
                                } else {
                                    echo '<td><img src="../resources/logo.png" alt="Image" style="max-width: 60px; object-fit: contain;"></td>';
                                }
                                echo '<td><input type="file" class="form-control" name="image"></td>';
                                echo '<td><button type="submit" class="btn btn-outline-success" style="font-size: 0.9rem;"><i class="bi bi-cloud-arrow-up"></i></button></td>';
                                echo '</form>';
                                echo '<form method="post" action="remove_stock.php">';
                                echo '<input type="hidden" name="item_id" value="' . $item['id'] . '">';
                                echo '<td><button type="submit" class="btn btn-outline-danger" style="font-size: 0.9rem;"><i class="bi bi-trash3-fill"></i></button></td>';
                                echo '</form>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php print ($commonFooter)?>
    <script>
        function clearSearch() {
            window.location.href = 'manage_stock.php';
        }
    </script>
</body>
</html>
