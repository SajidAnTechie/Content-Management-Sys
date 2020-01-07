<?php ob_start(); ?>
<?php include("includes/connection.php");?>
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
        <table class="table table-bordered table-striped table-hover "> 
            <thead class="bg-dark text-white text-center">
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Comment Date</th>
                <th>Post Title</th>
                <th>Post Id</th>
                <th>Actions</th>
            </thead>

            <?php
               if(isset($_GET["accept"])){
                    $get_id= htmlspecialchars($_GET["accept"]);
                    $sql_acc_up="UPDATE comments SET comment_status='accept' WHERE id='$get_id'";
                    mysqli_query($con,$sql_acc_up);
                }

                if(isset($_GET["deny"])){
                    $get_id= htmlspecialchars($_GET["deny"]);
                    $sql_acc_up="UPDATE comments SET comment_status='deny' WHERE id='$get_id'";
                    mysqli_query($con,$sql_acc_up);
                }
                if(isset($_GET["delete"])){
                    $get_id= htmlspecialchars($_GET["delete"]);
                    $sql_acc_up="DELETE FROM comments WHERE id =' $get_id'";
                    mysqli_query($con,$sql_acc_up);
                }
            ?>

            <tbody class="text-center text-aligh-center">
                  <?php
                    $query = "SELECT * FROM comments";
                    $select_all_infor = mysqli_query($con, $query);
                    $edit = 1;
                        while($row = mysqli_fetch_array($select_all_infor)){
                                $comment_id = htmlspecialchars($row["id"]);
                                $comment_author = htmlspecialchars($row["comment_author"]);
                                $comment_email = htmlspecialchars($row["comment_email"]);
                                $comment_text = htmlspecialchars($row["comment_text"]);
                                $comment_status = htmlspecialchars($row["comment_status"]);
                                $comment_date = htmlspecialchars($row["comment_date"]);
                                $comment_post_id = htmlspecialchars($row["comment_post_id"]);

                                $query2 = "SELECT * FROM upload WHERE id = '$comment_post_id'";
                                    $select_post_id_query = mysqli_query($con,$query2);
                                    while($row = mysqli_fetch_array($select_post_id_query)){
                                        $post_id = htmlspecialchars($row["id"]);
                                        $post_title = htmlspecialchars($row["username"]);
                                    }
                         
                             echo  '<tr>
                                    <td><div class="table-data">'.$comment_id.'</div></td>
                                    <td><div class="table-data">'.$comment_author.'</div></td>
                                    <td><div class="table-data">'.$comment_email.'</div></td>
                                    <td><div class="table-data">'.$comment_text.'</div></td>
                                    <td><div class="table-data">'.$comment_status.'</div></td>
                                    <td><div class="table-data">'.$comment_date.'</div></td>
                                    <td><div class="table-data">'.$post_title.'</div></td>
                                    <td><div class="table-data">'.$comment_post_id.'</div></td>
                                    <td>
                                    <div class="dropdown" style="top: 25px;">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#editmodal'.$edit.'" href="#">View Post</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="comment.php?accept='.$comment_id.'">Accept</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="comment.php?deny='.$comment_id.'">Deny</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="comment.php?delete='.$comment_id.'">Delete</a>
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
                <h5 class="modal-title" id="exampleModalLongTitle">View Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                      <form  method="post" action=""  enctype="multipart/form-data">
                        <div class="form-group">
                            <lable for="author">Comment Author:</lable>
                            <input type="text" name="comment_author" id="author" class="form-control"  value="<?php echo  $comment_author?>">
                        </div>
                        <div class="form-group ">
                            <lable for="email">Email</lable>
                            <input type="text" name="comment_email" id="email" class="form-control"  value="<?php echo $comment_email?>">
                        </div>
                        <div class="form-group">
                            <lable for="comment">Comment</lable><br/>
                            <textarea type="text" name="text" id="text" cols="20" rows="5" ><?php echo $comment_text?></textarea>
                        </div>
                        <div class="form-group ">
                            <lable for="email">Status</lable>
                            <label for="comment_status">Comment Status</label>
                                <select class="form-group">
                                <option><?php echo $comment_status ?></option>
                        </div>
                        <div class="form-group ">
                            <lable for="commented Post">Commented Post</lable>
                            <input type="text" name="Post_title" id="post_title" class="form-control"  value="<?php echo $post_title?>">
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="hidden" name="id" value="<?php echo $comment_id?>">
                            <input type="submit" name="View_post" id="submit" class="form-control btn btn-primary" value="View Post">
                        </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>
        
      <?php $edit++; } ?>
          <!-- end of edit section -->    
            </tbody>
        </table>
   </div>
</div>

            
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include("includes/admin_footer.php");?>
  </body>
</html>