<?php 
require('../middleware/protected_page.php');
require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');
require('dbConnect.php');

print($header);
?>
<body>
    <?php
    print($commonNav);
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success mt-3" id = "success-alert">Cart updated successfully.</div>';
    }
    ?>  
    <!-- Search Section -->
    <div class="container-fluid m-2">
    <section class="search-bar">
                <h2>Search Medicine</h2>
                <form action="search.php" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search_query" placeholder="Search for medicine...">
                        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </section>
            <!-- Featured Items Section -->
            <section class="featured-items mt-6">
                <h2 style="margin-top: 20px;">You might be interested to buy</h2>
                <div class="row ">
                    <?php
                    
                    // Fetch random items from the stock table as featured items
                    $sql_featured_items = "SELECT * FROM stock ORDER BY RAND() LIMIT 8";
                    $stmt_featured_items = $pdo->query($sql_featured_items);
                    //<!-- echo '<img class= "card-img-top" src="data:image/jpeg;base64,' . base64_encode($item['image']) . '" alt="Image" style="width: 100px;height: 100px;">'; -->
                    
                    while ($item = $stmt_featured_items->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="col-md-3 mt-2">';
                            echo '<div class="card h-100">';
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($item['image']) . '" class="card-img-top img-thumbnail img-fluid" alt="Medicine Image" style="width: auto; height: 200px; object-fit: contain;">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $item['medicine_name'] . '</h5>';
                            echo '<p class="card-text">Price: $' . $item['price'] . '</p>';
                            echo '<p class="card-text">Available Quantity: ' . $item['quantity'] . '</p>';
                            echo '<p class="card-text">Unit Count: ' . $item['unit'] . '</p>';
                            echo '<p class="card-text">Note: ' . $item['notes'] . '</p>';
                            echo '<form action="add_to_cart.php" method="post">';
                            echo '<input type="hidden" name="medicine_id" value="' . $item['id'] . '">';
                            echo '<input type="hidden" name="quantity" value="1">'; // Default quantity is 1
                            echo '<button type="submit" class="btn btn-primary w-100">Add to Cart</button>';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
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
        }, 2000);} 
    </script>
    <?php print ($commonFooter)?>
    
    </body>
    </html>