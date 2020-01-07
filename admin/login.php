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
    <title>Image Upload</title>
    <link rel="stylesheet" href="style2.css">
  </head>
  <body id="background-for-body">

        <!-- <?php
            if(isset($_POST["login_submit"])){
                $username=htmlspecialchars($_POST["username"]);
                $password=htmlspecialchars($_POST["password"]);
                $sql="SELECT * FROM user WHERE username='$username'" ;
                $select_db=mysqli_query($con,$sql);
                while($row=mysqli_fetch_array($select_db)){
                    $user=htmlspecialchars($row["username"]);
                    $pass=htmlspecialchars($row["password"]);
                }
                    if( $username == $user && $password == $pass ){
                        session_start();
                        $_SESSION["loggedin"] = true;
                      $_SESSION["username"] = $user_name;
                      $_SESSION["password"] = $user_password;
                        header("location:index.php");
                    }else{
                        header("location:login.php");
                    }

            }
        ?> -->

<?php
            if(isset($_POST["login_submit"])){
                $username=htmlspecialchars($_POST["username"]);
                $password=htmlspecialchars($_POST["password"]);
                $sql="SELECT * FROM user WHERE username='$username' AND password='$password'" ;
                $select_db=mysqli_query($con,$sql);
                $count_row=mysqli_num_rows($select_db);
               
                    if($count_row==1 ){
                        session_start();
                        $_SESSION["loggedin"] = true;
                      $_SESSION["username"] =  $username;
                      $_SESSION["password"] = $password;
                        header("location:index.php");
                    }else{
                        header("location:login.php");
                    }

            }
?>
        <div class="form-background">
            <form action="" method="post">
                    <div class="for-image">
                            <img id="avatar" src="img/avatar.png" alt="admin">
                    </div>
                   <div class="form-content">
                        <h3>Admin Login</h3>
                        <div class="form-group">
                            <label id="label-username" for="user">Username</label><br/>
                            <input id="username" type="text" name="username" id="user" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label id="label-password" for="password">Password</label><br/>
                            <input id="password" type="password" name="password" id="password"placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                                <input type="checkbox" id="show-password" onclick="passwordshow();" class="field__toggle-input" />
                                <label for="show-password" class="field__toggle">
                                        Show password
                                </label>
                        </div>
                        <div class="form-group">
                            <input  type="submit" name="login_submit" id="submit-login" value="Login">
                        </div>
          
                   </div>
            </form>
        </div>
     

            
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript">
 
        // Gather our DOM references.
        function passwordshow(){
         var x=  document.getElementById("password");
         if(x.type=="password"){
             x.type="text";
         }else{
            x.type="password";
         }

        }
    </script>
  </body>
</html>