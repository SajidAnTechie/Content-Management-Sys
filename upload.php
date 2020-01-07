<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Image Upload</title>
  </head>
  <body>
  <div class="container">
     <br/>
    <h1 class="text-center bg-dark text-white">Registered Username</h1><br/>

   <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover "> 
            <thead class="bg-dark text-white">
                <th>Id</th>
                <th>Username</th>
                <th>Profile</th>
            </thead>

            <tbody>

                <?php
                    $con=mysqli_connect("localhost","root","");
                    mysqli_select_db($con,"image");

                    if(isset($_POST["submit"])){

                            $user= $_POST["user"];

                            $files= $_FILES["files"];
                            $filename= $files["name"];
                            $filetmp= $files["tmp_name"];

                            $fileext= explode(".", $filename);
                            $filecheck= strtolower(end($fileext));

                            $fileextstored= array("png","jpg","jpeg");

                            if(in_array($filecheck,$fileextstored)){

                                $destinationfile= "img/".$filename;
                                move_uploaded_file($filetmp,$destinationfile);
                                
                                $sql="INSERT INTO upload(id, username, img) 
                                VALUES ('','$user','$destinationfile')";
                                 mysqli_query($con, $sql);  
                            }else{
                                echo "Extension Doesn't match";
                            }

                    }

                    
                    
                    $query = "SELECT * FROM upload" ;
                    $select_all_infor = mysqli_query($con, $query );
                        while($row = mysqli_fetch_array($select_all_infor)){
                                $user_id = htmlspecialchars($row["id"]);
                                $user_name = htmlspecialchars($row["username"]);
                                $user_profile = htmlspecialchars($row["img"]);
                            ?>
                               <tr>
                                    <td><?php echo $user_id ?></td>
                                    <td><?php echo  $user_name ?></td>
                                    <td><img src="<?php echo $user_profile ?>" width="100px" height="100px"></td>
                               </tr> 

                    <?php }?>

            </tbody>

        </table>
   </div>

  </div>
 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>