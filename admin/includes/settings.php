
<?php
        if(isset($_POST["add_admin"])){
            $username=htmlspecialchars($_POST["newuser"]);
            $pssworone=htmlspecialchars($_POST["passwordfirst"]);
            $psswortwo=htmlspecialchars($_POST["passwordtwo"]);

            if(empty( $username ||$pssworone ||$psswortwo)){
                echo "<script type=\"text/javascript\">window.alert('Please Fill the form');
                window.location.href = 'index.php';</script>";
            }elseif($pssworone == $psswortwo){
                $sql3="INSERT INTO user(id,username,password)VALUES('','$username',' $pssworone')";
                mysqli_query($con,$sql3);
                header("location:index.php");
            }else{
                echo "<script type=\"text/javascript\">window.alert('Please Fill the form');
                window.location.href = 'index.php';</script>";
            }
            
        }
?>



<?php
if(isset($_POST["edit_profile"])){
  $user_id =$_POST["id"];
  $files= $_FILES["files"];
  $filename= $files["name"];
  $filetmp= $files["tmp_name"];

  $fileext= explode(".", $filename);
  $filecheck= strtolower(end($fileext));

  $fileextstored= array("png","jpg","jpeg");

  if(empty($filetmp)) {
    $query = "SELECT * FROM user WHERE id = '$user_id'";
    $select_image = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($select_image)){
    $user_profile = htmlspecialchars($row["profile"]);
    }
    $sql2="UPDATE user SET profile='$user_profile' WHERE id='$user_id'";
    mysqli_query($con, $sql2);
    header("location:index.php");

} elseif(in_array($filecheck,$fileextstored)){

  $destinationfile= "../img/$filename";
  move_uploaded_file($filetmp,$destinationfile);
  
  $sql2="UPDATE user SET profile='$filename' WHERE id='$user_id'";
   mysqli_query($con, $sql2);
   header("location:index.php");

}else{
echo "<script type=\"text/javascript\">window.alert('File extension is not valid.');
window.location.href = 'index.php';</script>"; 
exit;
}
}
?>

<?php
   if(isset($_POST["edit_username"])){
     $id=htmlspecialchars($_POST["id"]);
     $username=htmlspecialchars($_POST["username"]);
     if(empty($username)){
      echo "<script type=\"text/javascript\">window.alert('Invalid Username');
      window.location.href = 'index.php';</script>"; 
     }else{
      $sql="UPDATE user SET username='$username' WHERE id='$id'";
      mysqli_query($con,$sql);
      echo "<script type=\"text/javascript\">window.alert('Login Expaired. Please login');
     window.location.href = 'logout.php';</script>"; 
 exit;
     }

   }
?>

<?php
  $error="";
   if(isset($_POST["edit_password"])){
     $id=htmlspecialchars($_POST["id"]);
     $passwordone=htmlspecialchars($_POST["passwordone"]);
     $passwordtwo=htmlspecialchars($_POST["passwordtwo"]);
     if(empty($passwordone || $passwordtwo)){
      echo "<script type=\"text/javascript\">window.alert('Invalid Password');
      window.location.href = 'index.php';</script>"; 
     }elseif($passwordone == $passwordtwo){
      $sql="UPDATE user SET password='$passwordone' WHERE id='$id'";
      mysqli_query($con,$sql);
      echo "<script type=\"text/javascript\">window.alert('Login Expaired. Please login');
     window.location.href = 'logout.php';</script>"; 
      exit;
     }else{
      echo "<script type=\"text/javascript\">window.alert('Passworddoesn't matchjed');
      window.location.href = 'index.php';</script>"; 
     }
      
   }
?>
<?php
    if(isset($_GET["remove"])){
      $get_id=$_GET["remove"];
      $sql="UPDATE user SET profile='profile-pic.png' WHERE id='$get_id'";
      mysqli_query($con,$sql);
    }
?>





    <?php 
        $user= $_SESSION["username"];
        $sql="SELECT * FROM user WHERE username='$user'";
        $selct_db=mysqli_query($con,$sql);
        $edit=1;
        $edit2=1;
        $edit3=1;
        while($row=mysqli_fetch_array($selct_db)){
            $username=htmlspecialchars($row["username"]);
            $id=htmlspecialchars($row["id"]);
            $pass=htmlspecialchars($row["password"]);
           
          ?>      
                  <div class="dropdown">
                  <i class="fas fa-cogs" id="sett"></i>
                                <button class=" bbtt dropdown-toggle" style="outline:none;"  id="dropdownMenuButton"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Settings
                                </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#editmodalforprofile<?php echo $edit?>" href="#">Change Profile</a>
                                      <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#editmodalforusername<?php echo $edit2?>" href="#">Change Username</a>
                                      <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#editmodalforpassword<?php echo $edit3?>" href="#">Change Password</a>
                                      <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#editmodaladdingadmin" href="#">Add Admin</a>
                                      <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="index.php?remove=<?php echo  $id?>">Remove Profile</a>
                            </div>
                    </div>

              <!-- edit section for profile pic -->
<div class="modal fade" id="editmodalforprofile<?php echo $edit?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                      <form  method="post" action=""  enctype="multipart/form-data">
                        <div class="form-group ">
                            <lable for="file">Profile Pic</lable>
                            <input type="File" name="files" id="profile_pic" class="form-control" placeholder="Choose File">
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="submit" name="edit_profile" id="submit" class="form-control btn btn-success" placeholder="Change">
                        </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>
           <!-- End of  edit section for profile pic -->

           <!-- edit section of username -->

           <div class="modal fade" id="editmodalforusername<?php echo $edit2?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                      <form  method="post" action="">
                        <div class="form-group ">
                            <label for="username">Write New Username</label>
                           <input type="text" name="username">
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="submit" name="edit_username" id="submit" class="form-control btn btn-success" placeholder="Change">
                        </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>

           <!--  End of edit section of username -->


           
           <!-- edit section of password -->

           <div class="modal fade" id="editmodalforpassword<?php echo $edit3?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                      <form  method="post" action="">
                        <div class="form-group ">
                            <label for="username">Write New Password</label>
                           <input type="text" name="passwordone" id="passwordFirst">
                           <p id="sajid"></p>
                        </div>
                        <div class="form-group ">
                            <label for="username">Confirm Password</label>
                           <input type="text" name="passwordtwo" id="passwordSecond">
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="submit" name="edit_password" id="submit" class="form-control btn btn-success" placeholder="Change">
                        </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>

           <!--  End of edit section of password -->

          <?php $edit++; $edit2++; $edit3++; } ?><br/>
    

          <div class="modal fade" id="editmodaladdingadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                      <form  method="post" action="">
                        <div class="form-group ">
                            <label for="username">New Admin Username</label><br/>
                           <input type="text" name="newuser" id="username">
                          
                        </div>
                        <div class="form-group ">
                            <label for="username">Password</label><br/>
                           <input type="text" name="passwordfirst" id="newpassword">
                        </div>
                        <p id="sajidtwo"></p>
                        <div class="form-group ">
                            <label for="username">Confirm Password</label><br/>
                           <input type="text" name="passwordtwo" id="confirmpassword">
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="submit" name="add_admin" id="submit" class="form-control btn btn-success" placeholder="Change">
                        </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>