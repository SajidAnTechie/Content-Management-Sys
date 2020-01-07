<?php ob_start(); ?>
<?php include("includes/connection.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({selector:'#po'});</script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Image Upload</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body id="for-post-back">

  <br><br><br><br><br>
 
  <section id="for-margin">
  <div class="container">
      <div class="row">
            <div class="col-sm-8">
                  <div class="row">
                     <?php

                          if(isset($_GET["categoryname"])){
                            $category_name = htmlspecialchars(preg_replace('/[^A-Za-z0-9-]/', '', $_GET["categoryname"]));
                          }else{
                            header("location:index.php");
                          }

                         
                          
                         

                          $sql3= "SELECT * FROM upload  WHERE category='$category_name'";
                          $select_all_post=mysqli_query($con, $sql3);
                          while($row= mysqli_fetch_array($select_all_post)){
                            $user_id = htmlspecialchars($row["id"]);
                            $username=htmlspecialchars($row["username"]);
                            $text = $row["post_text"];
                            $user_profile = htmlspecialchars($row["img"]);
                            $post_hit = htmlspecialchars($row["post_hit"]);
                            $post_date = htmlspecialchars($row["post_date"]);
                         
                              echo'<div class="col-sm-6">
                                  <div id="post-for-shadow">
                                                <div class="post-img">
                                                    <img id="post-img" src="img/'.$user_profile.'">
                                                </div>
                                            <div class="post-content">
                                                  <div class="post-hit">
                                                  <i id="eye" class="fas fa-eye"><span>'. $post_hit.'</span></i>
                                                  <i id="date"class="fas fa-clock"><span>'. $post_date.'</span></i>
                                                  </div>
                                                
                                                <div class="post-username">
                                                      <h2>'.$username.'</h2>
                                                </div>
                                                <div class="post-text">
                                                    <p>'.$text.'</p>
                                                </div>
                                                <div class="post-button">
                                                    <a href="post.php?id='.$user_id.'" class="btn btn-primary">Read More</a>
                                                </div>
                                          </div>
                                  </div>
                                       
                              </div>';
                          }
                        ?>
                  </div>
            </div>

            <?php include("includes/sidebar.php");?>
      </div>
  </div>
  </section> 
<br/><br/><br/><br/><br/>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  </body>
</html>