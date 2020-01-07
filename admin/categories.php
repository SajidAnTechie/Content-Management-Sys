<?php ob_start(); ?>
<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
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
    <title>Image Upload</title>
    
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
  </head>
  <body>
  <?php include("includes/admin_header.php");?>
  <?php include("includes/admin_sidebar.php");?>
     <br/>
    <h1 class="text-black" style="font-size: 28px;">Welcome To Admin Page</h1><br/>

   <div class="table-responsive">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myform">
            Add Category
        </button>

        <table class="table table-bordered table-striped table-hover "> 
            <thead class="bg-dark text-white text-center">
                <th>Id</th>
                <th>Category Name</th>
                <th>Actions</th>
            </thead>

            <tbody class="text-center text-aligh-center">

                <?php
                $error=""; 
                    include("includes/connection.php");
                    if(isset($_POST["add_category"])){
                        $category=htmlspecialchars($_POST["category"]);
                        $sql="INSERT INTO category(Category_NAme)VALUES('$category')";
                        mysqli_query($con,$sql);
                        header("location:categories.php");
                    }
                  ?>

                <?php
                  if(isset($_POST["edit_category"])){
                    $edit_cat=htmlspecialchars($_POST["category"]);
                    $edit_cat_id=htmlspecialchars($_POST["id"]);
                    $sql2="UPDATE category SET Category_Name='$edit_cat' WHERE id='$edit_cat_id'";
                    mysqli_query($con,$sql2);
                    header("location:categories.php");
                }


              ?>

                  
         <?php
        if(isset($_GET["delete_cat"])){
            
             $del_cat_id = htmlspecialchars($_GET["delete_cat"]);
            $sql_query = "DELETE FROM category WHERE id = '$del_cat_id'";
            $delete_cat_query = mysqli_query($con, $sql_query);
            
        }
    
        ?>


                  <?php
                    $query = "SELECT * FROM category" ;
                    $select_all_infor = mysqli_query($con, $query );
                    $edit = 1;
                        while($row = mysqli_fetch_array($select_all_infor)){
                                $category_id = htmlspecialchars($row["id"]);
                                $category_name = htmlspecialchars($row["Category_Name"]);
                             echo  '<tr>
                                    <td><div class="table-data">'.$category_id.'</div></td>
                                    <td><div class="table-data">'.$category_name.'</div></td>
                                    <td>
                                    <div class="dropdown" style="top: 25px;">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#editmodal'.$edit.'" href="#">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="categories.php?delete_cat='.$category_id.'">Delete</a>
                                            </div>
                                            </div>
                                          </td>
                                         </tr>'; 
                          ?>


                  <!-- edit-section -->

<div class="modal fade" id="editmodal<?php echo $edit?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                      <form  method="post" action=""  enctype="multipart/form-data">
                      <div class="form-group">
                            <lable for="user">Category Name:</lable>
                            <input type="text" name="category" id="category" class="form-control" placeholder="Category Name" value="<?php echo $category_name?>">
                        </div>
                        <div class="form-group col-lg-4">
                             <input type="hidden" name="id" value="<?php echo $category_id ?>">
                            <input type="submit" name="edit_category" id="edit" class="form-control btn btn-success" placeholder="Edit Category">
                        </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>
          
          <!-- end of edit section -->


                    <?php $edit++; }?>
            </tbody>
        </table>
   </div>
</div>

            <!-- Add CAtegory Section -->
            
          <div class="modal fade" id="myform" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Catery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                      <form  method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <lable for="user">Category Name:</lable>
                            <input type="text" name="category" id="category" class="form-control" placeholder="Category Name">
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="submit" name="add_category" id="submit" class="form-control btn btn-success" placeholder="Add Category">
                        </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>
                           <!-- End Of  Add Category Section -->





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include("includes/admin_footer.php");?>
  </body>
</html>