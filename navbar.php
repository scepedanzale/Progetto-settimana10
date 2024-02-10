<?php
session_start();
?>

<nav class="navbar violet-bg sticky-top">
  <div class="container-fluid d-flex justify-content-between">
    <div>
      <a class="navbar-brand btn text-light" href="index.php "><i class="bi bi-book"></i> Cielo's Books</a>
    </div>
    <ul class="navbar-nav">
      <?php
        if(!isset($_SESSION['userLogin'])){?>
          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="register.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="login.php">Login</a>
          </li>
          
      <?php }else{ ?>
        <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="profile.php">
              <img src=<?=$_SESSION['userLogin']['img']?> alt="immagine profilo" height="50" class="rounded-2">
            </a>
          </li>
      <?php } ?>
    </ul>
  </div>
</nav>
