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
    print($adminNav);?>
  <div class="container-fluid m-2">
    <div class="gap-2 mb-3 d-inline">
      <a href="admin.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
      <!-- <a href="add_user.php" class="btn btn-primary ">Create User</a> -->
      <p class="text-center fs-2 fw-bold">Manage Users</p>
    </div>
    <table class="table">
      <thead>
        <tr>
          <!-- <th scope="col">#</th> -->
          <th scope="col">Name</th>
          <th scope="col">Phone</th>
          <th scope="col">Email</th>
          <th scope="col">Message</th>
          <th scope="col">Actions</th>
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
      $sql = "SELECT id, name, email, message,phone FROM contact_us
              WHERE active =1";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($users as $user) {
        echo ' <tr> ';
        // echo '<th scope="row">'.$user['id'].'</th> ' ;
        echo '<td>'.$user['name'].'</td> ' ;
        echo '<td>'.$user['phone'].'</td> ' ;
        echo '<td>'.$user['email'].'</td> ' ;
        echo '<td><span class="overflow-scroll">'.$user['message'].'<span></td> ' ;
        echo '<td><button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></button></td>' ;
        // echo '</tr> ' ;
      }
      ?>

      </tbody>
    </table>
  </div>

  <?php print ($commonFooter)?>
</body>

</html>