<?php
require('header.php');
print($header);
?>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php">PharmaCo</a>
</div>
<div class="navbar" id="navbarNavDropdown">
      <!-- <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="search.php">Search Medicine</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
        </li>
      </ul> -->
    </div>
</nav>
    <form class='loginForm' id="loginForm" action="loginHandler.php" method="post">
        <div class="imgcontainer">
            <img src="img_avatar2.png" alt="Avatar" class="avatar">
        </div>
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
            <p>New Here <a href="http://localhost/signup.php">SignUp</a></p>
        </div>
    </form>
    <script src="./script.js"></script>
</body>

</html>