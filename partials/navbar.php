<?php
// session_start();
if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
  $commonNav = '<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
      <a class="navbar-brand" href="../views/home.php"><img src="../resources/logo.png" alt="Pharmacy Logo">PharmyLand</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto ms-auto">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../views/admin.php">Admin Panel <i class="bi bi-person-circle"></i></a>
              </li> 
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../views/user.php">Profile <i class="bi bi-person-circle"></i></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../views/cart.php">Cart <i class="bi bi-bag-heart"></i></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../views/logout.php">Logout <i class="bi bi-box-arrow-right"></i></a>
              </li>   
          </ul>
      </div>
  </div>
  </nav>
  <div class="loader-wrapper">
    <div class="loader"></div>
</div>
';
}else{
  $commonNav = '<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
      <a class="navbar-brand" href="../views/home.php"><img src="../resources/logo.png" alt="Pharmacy Logo">PharmyLand</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto ms-auto">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../views/user.php">Profile <i class="bi bi-person-circle"></i></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../views/cart.php">Cart <i class="bi bi-bag-heart"></i></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../views/logout.php">Logout <i class="bi bi-box-arrow-right"></i></a>
              </li>   
          </ul>
      </div>
  </div>
  </nav>
  <div class="loader-wrapper">
    <div class="loader"></div>
</div>
';
}


  $adminNav = '<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
      <a class="navbar-brand" href="../views/admin.php"><img src="../resources/logo.png" alt="Pharmacy Logo">PharmyLand</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto ms-auto">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../views/logout.php">Logout <i class="bi bi-box-arrow-right"></i></a>
              </li>
          </ul>
      </div>
  </div>
  </nav>
  <div class="loader-wrapper">
    <div class="loader"></div>
</div>
';
  $loginNav = '<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php"><img src="../resources/logo.png" alt="Pharmacy Logo">PharmyLand</a>
    </div>
    </nav>
    <div class="loader-wrapper">
    <div class="loader"></div>
</div>
';


$indexPageNav = '<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php"><img src="../resources/logo.png" alt="Pharmacy Logo">PharmyLand</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto ms-auto">
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="#featuredProduct">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contactusdiv">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link flex-end " href="../views/login.php">Login <i class="bi bi-box-arrow-in-left"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="loader-wrapper">
  <div class="loader"></div>
</div>
';
?>