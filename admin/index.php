<?php ob_start(); ?>
<?php include("includes/connection.php");?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Admin Dashbord</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin.css" rel="stylesheet">
    <link href="style2.css" rel="stylesheet" >
  </head>
  <body>
<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php include("includes/admin_header.php");?>
<?php include("includes/admin_sidebar.php");?>

    <!-- Icon Cards-->
    <div class="row">
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5"><?php
                  $query = "SELECT * FROM upload";
                  $select_all_posts = mysqli_query($con,$query);
                  $post_count = mysqli_num_rows($select_all_posts);
                  echo "{$post_count} Posts";
                  ?></div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-info o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <div class="mr-5"><?php
                  $query = "SELECT * FROM category";
                  $select_all_categories = mysqli_query($con,$query);
                  $category_count = mysqli_num_rows($select_all_categories);
                  echo "{$category_count} Categories";
                  ?></div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5"><?php
                  $query = "SELECT * FROM comments";
                  $select_all_comments = mysqli_query($con,$query);
                  $comment_count = mysqli_num_rows($select_all_comments);
                  echo "{$comment_count} Comments";
                  ?></div>
                </div>
              </div>
            </div>
          </div>


        </div>
            
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include("includes/admin_footer.php");?>
  </body>
</html>