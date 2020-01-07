
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
        while($row=mysqli_fetch_array($selct_db)){
            $profile=htmlspecialchars($row["profile"]);
          ?>
            <div class="for-profile-style">
                  <div id="profile-img"><img src="../img/<?php echo $profile ?>" width="100px" height="100px" id="profile"></div>
            </div>

              <!-- edit section for profile pic -->

           <!--  End of edit section of password -->

          <?php  } ?>
    
