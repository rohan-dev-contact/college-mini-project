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
        echo '<div class="alert alert-success mt-3">Cart updated successfully.</div>';
    }
    ?>
    <main>
        <div class="container">
            
                <div class="span2 gap-2 mb-3 d-inline">
                            <a href="home.php" class="btn btn-secondary">Back</a>
                        </div>
                      
            <section class="search-bar">
                <h2>Search Medicine</h2>
                <form action="search.php" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search_query"
                            placeholder="Search for medicine...">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </section>
            <section class="search-results">
                <h2>Search Results</h2>
                <div class="row">
                    <?php
                    
                    // Get the search query from the URL
                    $search_query = $_GET['search_query'];
                    
                    // Fetch items from the stock table that match the search query
                    $sql_search_items = "SELECT * FROM stock WHERE medicine_name LIKE :search_query";
                    $stmt_search_items = $pdo->prepare($sql_search_items);
                    $stmt_search_items->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
                    $stmt_search_items->execute();
                    
                    while ($item = $stmt_search_items->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="col-md-3">';
                        echo '<div class="card h-100">';
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($item['image']) . '" class="card-img-top" alt="Medicine Image">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $item['medicine_name'] . '</h5>';
                        echo '<p class="card-text">Price: $' . $item['price'] . '</p>';
                        echo '<p class="card-text">Available Quantity: ' . $item['quantity'] . '</p>';
                        echo '<p class="card-text">Unit Count: ' . $item['unit'] . '</p>';
                        echo '<p class="card-text">Note: ' . $item['notes'] . '</p>';
                        echo '<form action="add_to_cart.php" method="post">';
                        echo '<input type="hidden" name="medicine_id" value="' . $item['id'] . '">';
                        echo '<input type="hidden" name="quantity" value="1">'; // Default quantity is 1
                        echo '<button type="submit" class="btn btn-primary">Add to Cart</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    
                    ?>
                </div>
            </section>
            
        </div>
    </main>
    <?php print ($commonFooter)?>
    <script>
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
        successAlert.style.display = 'block';
        setTimeout(function() {
            successAlert.style.display = 'none';
        }, 2000); }
    </script>
</body>


</html>