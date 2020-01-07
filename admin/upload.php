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
    <script src='https://cloud.tinymce.com/5/tinymce.min.js?apiKey=d4bbcq01sagjvjvfmn96be4w23p4fho95uy90b75oqmmgei2'></script>
    <script>
        tinymce.init({
        selector: 'textarea',
        height: 350,
          plugins: 'advlist autolink link image lists charmap print preview',
          content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tiny.cloud/css/codepen.min.css'
          ],
  formats: {
    alignleft: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'left' },
    aligncenter: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'center' },
    alignright: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'right' },
    alignfull: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'full' },
    bold: { inline: 'span', 'classes': 'bold' },
    italic: { inline: 'span', 'classes': 'italic' },
    underline: { inline: 'span', 'classes': 'underline', exact: true },
    strikethrough: { inline: 'del' },
    customformat: { inline: 'span', styles: { color: '#00ff00', fontSize: '20px' }, attributes: { title: 'My custom format' }, classes: 'example1' }
  },
  style_formats: [
    { title: 'Custom format', format: 'customformat' },
    { title: 'Align left', format: 'alignleft' },
    { title: 'Align center', format: 'aligncenter' },
    { title: 'Align right', format: 'alignright' },
    { title: 'Align full', format: 'alignfull' },
    { title: 'Bold text', inline: 'strong' },
    { title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
    { title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
    { title: 'Badge', inline: 'span', styles: { display: 'inline-block', border: '1px solid #2276d2', 'border-radius': '5px', padding: '2px 5px', margin: '0 2px', color: '#2276d2' } },
    { title: 'Table row 1', selector: 'tr', classes: 'tablerow1' },
    { title: 'Image formats' },
    { title: 'Image Left', selector: 'img', styles: { 'float': 'left', 'margin': '0 10px 0 10px' } },
    { title: 'Image Right', selector: 'img', styles: { 'float': 'right', 'margin': '0 0 10px 10px' } },
  ]
});
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Post</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="style2.css">
  </head>
  <body>
  <?php include("includes/admin_header.php");?>
  <?php include("includes/admin_sidebar.php");?>
     <br/>
     <h1 class="text-black" style="font-size: 28px;">Welcome To Admin Page</h1><br/>

   <div class="table-responsive">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myform">
            Add Post
        </button>

        <table class="table table-bordered table-striped table-hover "> 
            <thead class="bg-dark text-white text-center">
                <th>Id</th>
                <th>Username</th>
                <th>Text</th>
                <th>Category</th>
                <th>Profile</th>
                <th>Post Date</th>
                <th>Comments</th>
                <th>Actions</th>
            </thead>

            <tbody class="text-center text-aligh-center">

                <?php
                $error=""; 
                    include("includes/connection.php");

                    if(isset($_POST["submit"])){
                      $text="";
                            $user= $_POST["user"];
                            $text=$_POST["text"];
                            $category=$_POST["select_category"];
                            $files= $_FILES["files"];
                            $filename= $files["name"];
                            $filetmp= $files["tmp_name"];
                            $post_date = date("d-m-y");

                            $fileext= explode(".", $filename);
                            $filecheck= strtolower(end($fileext));

                            $fileextstored= array("png","jpg","jpeg");

                            if(in_array($filecheck,$fileextstored)){

                                $destinationfile= "../img/$filename";
                                move_uploaded_file($filetmp,$destinationfile);
                                
                                $sql="INSERT INTO upload(id,category, username,post_text, img,post_date) 
                                VALUES ('','$category','$user','$text','$filename',now())";
                                 mysqli_query($con, $sql);
                                 header("location:upload.php");

                            }else{
                             
                              echo "<script type=\"text/javascript\">window.alert('File extension is not valid.');
                              window.location.href = 'upload.php';</script>"; 
                                exit;
                            }

                    }
                  ?>

                <?php


                  if(isset($_POST["edit_post"])){
                    $user= $_POST["user"];
                    $text= $_POST["text"];
                    $category=$_POST["select_category"];
                    $user_id =$_POST["id"];
                    $files= $_FILES["files"];
                    $filename= $files["name"];
                    $filetmp= $files["tmp_name"];

                    $fileext= explode(".", $filename);
                    $filecheck= strtolower(end($fileext));

                    $fileextstored= array("png","jpg","jpeg");

                    if(empty($filetmp)) {
                      $query = "SELECT * FROM upload WHERE id = '$user_id'";
                      $select_image = mysqli_query($con, $query);
                      while($row = mysqli_fetch_array($select_image)){
                      $user_profile = htmlspecialchars($row["img"]);
                      }
                      $sql2="UPDATE upload SET username='$user',category='$category',post_text='$text',img='$user_profile' WHERE id='$user_id'";
                      mysqli_query($con, $sql2);
                      header("location:upload.php");
           
                  } elseif(in_array($filecheck,$fileextstored)){

                    $destinationfile= "../img/$filename";
                    move_uploaded_file($filetmp,$destinationfile);
                    
                    $sql2="UPDATE upload SET username='$user',post_text='$text',img='$filename' WHERE id='$user_id'";
                     mysqli_query($con, $sql2);
                     header("location:upload.php");

                }else{
                  echo "<script type=\"text/javascript\">window.alert('File extension is not valid.');
                  window.location.href = 'upload.php';</script>"; 
                  exit;
                }
          }


              ?>

                  
        <?php
        if(isset($_GET["delete"])){
            
             $del_post_id = htmlspecialchars($_GET["delete"]);
            $sql_query = "DELETE FROM upload WHERE id = '$del_post_id'";
            $delete_post_query = mysqli_query($con, $sql_query);
        }
    
        ?>


                  <?php
                    $query = "SELECT * FROM upload" ;
                    $select_all_infor = mysqli_query($con, $query );
                    $edit = 1;
                        while($row = mysqli_fetch_array($select_all_infor)){
                                $user_id = htmlspecialchars($row["id"]);
                                $user_name = htmlspecialchars($row["username"]);
                                $category=htmlspecialchars($row["category"]);
                                $text =$row["post_text"];
                                $user_profile = htmlspecialchars($row["img"]);
                                $post_date = htmlspecialchars($row["post_date"]);

                                $sql="SELECT * FROM comments WHERE comment_post_id='$user_id' AND comment_status='accept'";
                                $select_comment=mysqli_query($con,$sql);
                                $count_num_rows=mysqli_num_rows($select_comment);
                         
                             echo  '<tr>
                                    <td><div class="table-data">'.$user_id.'</div></td>
                                    <td><div class="table-data">'.$user_name.'</div></td>
                                    <td><div class="table-data">'.$text.'</div></td>
                                    <td><div class="table-data">'.$category.'</div></td>
                                    <td><img src="../img/'.$user_profile.'" width="100px" height="100px"></td>
                                    <td><div class="table-data">'.$post_date.'</div></td>
                                    <td><div class="table-data">'.$count_num_rows.'</div></td>
                                    <td>
                                    <div class="dropdown" style="top: 25px;">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#editmodal'.$edit.'" href="#">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="upload.php?delete='.$user_id.'">Delete</a>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                      <form  method="post" action=""  enctype="multipart/form-data">
                        <div class="form-group">
                            <lable for="user">Username:</lable>
                            <input type="text" name="user" id="user" class="form-control" placeholder="Your Name" value="<?php echo  $user_name ?>">
                        </div>
                        <div class="form-group ">
                            <lable for="file">Profile Pic</lable>
                            <img src="../img/<?php echo $user_profile ?>" width="100px" height="100px">
                            <input type="File" name="files" id="file" class="form-control" placeholder="Choose File" value="<?php echo $user_profile?>">
                        </div>
                        <div class="form-group">
                            <lable for="user">Text</lable><br/>
                            <textarea type="text" name="text" id="text" ><?php echo $text;?></textarea>
                        </div>

                        <div class="form-group">
                            <lable for="user">Edit Category</lable><br/>
                           <select name="select_category" id="category">
                                <?php
                                    $sql="SELECT * FROM category";
                                    $select_all_category=mysqli_query($con,$sql);
                                    while($row=mysqli_fetch_array($select_all_category)){
                                      $category=htmlspecialchars($row["Category_Name"]);

                                      echo'<option value="'.$category.'">'.$category.'</option>';
                                    }
                                   
                                ?>

                           </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="hidden" name="id" value="<?php echo  $user_id ?>">
                            <input type="submit" name="edit_post" id="submit" class="form-control btn btn-success" placeholder="Update">
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

            <!-- Add Post Section -->
            
          <div class="modal fade" id="myform" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                      <form  method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <lable for="user">Username:</lable>
                            <input type="text" name="user" id="user" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="form-group ">
                            <lable for="file">Profile Pic</lable>
                            <input type="File" name="files" id="file" class="form-control" placeholder="Choose File">
                        </div>
                        <div class="form-group">
                            <lable for="user">Text</lable><br/>
                            <textarea type="text" name="text" id="po"></textarea>
                        </div>

                        <div class="form-group">
                            <lable for="user">Slect Category</lable><br/>
                           <select name="select_category" id="category">
                                <?php
                                    $sql="SELECT * FROM category";
                                    $select_all_category=mysqli_query($con,$sql);
                                    while($row=mysqli_fetch_array( $select_all_category)){
                                      $category=htmlspecialchars($row["Category_Name"]);
                                      echo'<option>'.$category.'</option>';
                                    }
                                   
                                ?>

                           </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="submit" name="submit" id="submit" class="form-control btn btn-success" placeholder="submit">
                        </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>
                           <!-- End Of Add Post Section -->





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include("includes/admin_footer.php");?>
  </body>
</html>