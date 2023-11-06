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
.my-class-to-b{
        margin-bottom : 50px
    }
</style>
<body>
    <?php
    print($commonNav); // Use the common navigation bar
    ?>

    <div class="container mt-5 my-class-to-b">
        <div class="gap-2 mb-3 d-inline">
            <a href="admin.php" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back to Admin Panel">
            <i class="bi bi-arrow-left"></i> Back to Admin Panel
            </a>
            <a href="add_user.php" class="btn btn-outline-primary">Create User</a>
            
            <p class="text-center fs-4 fw-bold">Manage Users</p>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <form class="mb-3" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search_data" placeholder="Search user..." style="font-size: 0.9rem;" value="<?php echo isset($_GET['search_data']) ? htmlspecialchars($_GET['search_data']) : ''; ?>">
                        <button class="btn btn-outline-primary" type="submit" style="font-size: 0.9rem;">
                            <i class="bi bi-search"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="clearSearch()">Clear</button>
                    </div>
                </form>

                <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Include your database connection configuration
                            require('dbConnect.php');

                            // Fetch users from the database
                            $searchTerm = isset($_GET['search_data']) ? $_GET['search_data'] : '';
                            $sql = "SELECT id, name, email, phone, role FROM users
                                    WHERE name LIKE :searchTerm OR email LIKE :searchTerm OR phone LIKE :searchTerm OR role LIKE :searchTerm";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
                            $stmt->execute();
                            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($users as $user) {
                                echo '<tr>';
                                echo '<form method="post" action="update_user.php">';
                                echo '<input type="hidden" name="user_id" value="' . $user['id'] . '">'; // Include user ID for updating
                                echo '<td><input type="text" class="form-control" name="name" value="' . $user['name'] . '" style="font-size: 0.9rem;"></td>';
                                echo '<td><input type="text" class="form-control" name="email" value="' . $user['email'] . '" style="font-size: 0.9rem;"></td>';
                                echo '<td><input type="text" class="form-control" name="phone" value="' . $user['phone'] . '" style="font-size: 0.9rem;"></td>';
                                echo '<td><input type="text" class="form-control" name="role" value="' . $user['role'] . '" style="font-size: 0.9rem;"></td>';
                                echo '<td><button type="submit" class="btn btn-outline-success" style="font-size: 0.9rem;"><i class="bi bi-cloud-arrow-up"></i></button></td>';
                                echo '</form>';
                                echo '</form>';
                                echo '<form method="post" action="remove_user.php">';
                                echo '<input type="hidden" name="user_id" value="' . $user['id'] . '">'; // Include user ID for removal
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
        // Function to clear the search query and reload the page
        function clearSearch() {
            window.location.href = 'manage_user.php';
        }
    </script>
</body>
</html>
