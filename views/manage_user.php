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
    print($commonNav);
    ?>
    <div class="container mt-5">
        <h1 class="text-center">Manage Users</h1>
        <div class="span2 gap-2 mb-3">
                    <a href="admin.php" class="btn btn-secondary">Back to Admin Portal</a>
                </div>
                <div class="span2 gap-2 mb-3">
                    <a href="add_user.php" class="btn btn-secondary">Create New User</a>
                </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <form class="mb-3" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search user...">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
    
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include your database connection configuration
                        require('dbConnect.php');
    
                        // Fetch users from the database
                        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
                        // echo $searchTerm;

                        // Fetch users from the database based on search query
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
                            echo '<td><input type="text" class="form-control" name="name" value="' . $user['name'] . '"></td>';
                            echo '<td><input type="text" class="form-control" name="email" value="' . $user['email'] . '"></td>';
                            echo '<td><input type="text" class="form-control" name="phone" value="' . $user['phone'] . '"></td>';
                            echo '<td><input type="text" class="form-control" name="role" value="' . $user['role'] . '"></td>';
                            echo '<td><button type="submit" class="btn btn-success">Update</button></td>';
                            echo '</form>';
                            echo '</form>';
                            echo '<form method="post" action="remove_user.php">';
                            echo '<input type="hidden" name="user_id" value="' . $user['id'] . '">'; // Include user ID for removal
                            echo '<td><button type="submit" class="btn btn-danger">Remove</button></td>';
                            echo '</form>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <?php print ($commonFooter)?>
</body>

</html>