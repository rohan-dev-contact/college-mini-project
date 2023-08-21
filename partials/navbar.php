<?php
$commonNav = '<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
      <a class="navbar-brand" href="../index.php"><img src="../resources/logo.png" alt="Pharmacy Logo">PharmyLand</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto ms-auto">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../views/cart.php"><i class="bi bi-bag-heart"></i></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../views/logout.php"><i class="bi bi-box-arrow-right"></i></a>
              </li>   
          </ul>
      </div>
  </div>
  </nav>';

  $adminNav = '<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
      <a class="navbar-brand" href="../index.php"><img src="../resources/logo.png" alt="Pharmacy Logo">PharmyLand</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto ms-auto">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../views/logout.php"><i class="bi bi-box-arrow-right"></i></a>
              </li>
          </ul>
      </div>
  </div>
  </nav>';
  $loginNav = '<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php"><img src="../resources/logo.png" alt="Pharmacy Logo">PharmyLand</a>
    </div>
    </nav>';


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
            <a class="nav-link flex-end " href="../views/login.php"><i class="bi bi-box-arrow-in-left"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
';
?>