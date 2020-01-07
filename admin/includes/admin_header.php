<?php ob_start(); ?>
<?php include("includes/connection.php");?>
<body id="page-top">

<nav class="navbar navbar-expand navbar-dark static-top" style="background-color: #168eea;height: 84px;">


  <div class="for-background-admin-logo" id="tinted-image-two">
         <?php include("includes/profile.php");?>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#" style="height: 38px;
    position: relative;
    top: 21px;">
      <i id="side" class="fas fa-bars"></i>
        </button>

  </div>
  
  <!-- Navbar -->
  <form class="form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
<div class="btn-group">
<div class="col">

<div class="welcome" style="display: inline-block;color: white;font-size: 20px;padding-right: 26px;font-weight: bold;">Welcome, <font color="#192a56"><?php echo htmlspecialchars($_SESSION["username"]); ?></font></div>


<button type="button" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">
<a class="text-white" href="logout.php">Logout</a>
</button>
</div>
</div>
</form>
</nav>