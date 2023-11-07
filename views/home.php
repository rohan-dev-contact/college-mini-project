<?php
require('../middleware/protected_page.php');
require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');
require('dbConnect.php');

print($header);
?>

<body>
    <?php print($commonNav); ?>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success mt-3" id="success-alert">Cart updated successfully.</div>';
    }
    ?>

    <div class="container mt-3">
        <section class="search-bar">
            <h2 class="mb-2" style="font-size: 1.5rem;">Search for Medicines</h2>
            <form action="home.php" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="search_query" placeholder="Enter the medicine name..." style="font-size: 1rem;" value="<?php echo isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : ''; ?>">
                    <button type="submit" class="btn btn-outline-primary" style="font-size: 1rem;"><i class="bi bi-search"></i> Search</button>
                    <button type="button" class="btn btn-secondary" onclick="clearSearch()" style="font-size: 1rem;">Clear</button>
                </div>
            </form>
        </section>
    </div>

    <div class="container mt-3">
        <section class="featured-items">
            
            <div class="row" style="overflow-y: scroll; max-height: calc(100vh - 300px); /* Adjust the height to your preference */">
                <?php
                // Get the search query from the URL
                if (isset($_GET['search_query'])) {
                    echo ' <h2 class="mb-2" style="font-size: 1.5rem;">Search Result</h2>';
                   $search_query = $_GET['search_query'];

               
                   $sql_search_items = "SELECT * FROM stock WHERE isDeleted = 0 and medicine_name LIKE :search_query";
                   $stmt_search_items = $pdo->prepare($sql_search_items);
                   $stmt_search_items->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
                   $stmt_search_items->execute();

                   while ($item = $stmt_search_items->fetch(PDO::FETCH_ASSOC)) {
                       echo '<div class="col-md-3 mt-3">';
                       echo '<div class="card h-100 shadow">';
                    //    echo '<img src="data:image/jpeg;base64,' . base64_encode($item['image']) . '" class="card-img-top img-fluid" alt="Medicine Image" style="width: auto; height: 200px; object-fit: contain;">';
                        if (!empty($item['image'])) {
                            echo '<td><img src="data:image/jpeg;base64,' . base64_encode($item['image']) . '" alt="Image" style="width: auto; height: 200px; object-fit: contain;"></td>';
                        } else {
                            echo '<td><img src="../resources/logo.png" alt="Image" style="width: auto; height: 200px; object-fit: contain;"></td>';
                        }
                       echo '<div class="card-body">';
                       echo '<h5 class="card-title" style="font-size: 1rem;">' . $item['medicine_name'] . '</h5>';
                       echo '<p class="card-text" style="font-size: 0.9rem;">Price: $' . $item['price'] . '</p>';
                       echo '<p class="card-text" style="font-size: 0.9rem;">Quantity: ' . $item['quantity'] . '</p>';
                       echo '<p class="card-text" style="font-size: 0.9rem;">Unit Type: ' . $item['unit'] . '</p>';
                       echo '<p class="card-text" style="font-size: 0.9rem;">Note: ' . $item['notes'] . '</p>';
                       echo '<form action="add_to_cart.php" method="post">';
                       echo '<input type="hidden" name="medicine_id" value="' . $item['id'] . '">';
                       echo '<input type="hidden" name="quantity" value="1">'; // Default quantity is 1
                       echo '<button type="submit" class="btn btn-primary w-100" style="font-size: 0.9rem;">Add to Cart</button>';
                       echo '</form>';
                       echo '</div>';
                       echo '</div>';
                       echo '</div>';
               }
               }else{
                echo ' <h2 class="mb-2" style="font-size: 1.5rem;">Explore Featured Medicines</h2>';
                   $sql_featured_items = "SELECT * FROM stock where isDeleted = 0 ORDER BY RAND() LIMIT 8 ";
                   $stmt_featured_items = $pdo->query($sql_featured_items);
   
                   while ($item = $stmt_featured_items->fetch(PDO::FETCH_ASSOC)) {
                       echo '<div class="col-md-3 mt-3">';
                       echo '<div class="card h-100 shadow">';
                       //    echo '<img src="data:image/jpeg;base64,' . base64_encode($item['image']) . '" class="card-img-top img-fluid" alt="Medicine Image" style="width: auto; height: 200px; object-fit: contain;">';
                        if (!empty($item['image'])) {
                            echo '<td><img src="data:image/jpeg;base64,' . base64_encode($item['image']) . '" alt="Image" style="width: auto; height: 200px; object-fit: contain;"></td>';
                        } else {
                            echo '<td><img src="../resources/logo.png" alt="Image" style="width: auto; height: 200px; object-fit: contain;"></td>';
                        }
                       echo '<div class="card-body">';
                       echo '<h5 class="card-title" style="font-size: 1rem;">' . $item['medicine_name'] . '</h5>';
                       echo '<p class="card-text" style="font-size: 0.9rem;">Price: $' . $item['price'] . '</p>';
                       echo '<p class="card-text" style="font-size: 0.9rem;">Quantity: ' . $item['quantity'] . '</p>';
                       echo '<p class="card-text" style="font-size: 0.9rem;">Unit Type: ' . $item['unit'] . '</p>';
                       echo '<p class="card-text" style="font-size: 0.9rem;">Note: ' . $item['notes'] . '</p>';
                       echo '<form action="add_to_cart.php" method="post">';
                       echo '<input type="hidden" name="medicine_id" value="' . $item['id'] . '">';
                       echo '<input type="hidden" name="quantity" value="1">'; // Default quantity is 1
                       echo '<button type="submit" class="btn btn-primary w-100" style="font-size: 0.9rem;">Add to Cart</button>';
                       echo '</form>';
                       echo '</div>';
                       echo '</div>';
                       echo '</div>';
                   }
               }
              
                ?>
            </div>
        </section>
    </div>

    <script>
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.display = 'block';
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 2000);
        }

        function clearSearch() {
            window.location.href = 'home.php';
        }
    </script>

    <?php print ($commonFooter)?>
</body>
</html>
