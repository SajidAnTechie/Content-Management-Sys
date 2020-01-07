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

        <?php
                if(isset($_GET["id"])){
                    $post_id_ind =htmlspecialchars(preg_replace('/[^A-Za-z0-9-]/', '', $_GET["id"]));
                    $sql3="UPDATE upload SET post_hit= post_hit+1 WHERE  id='$post_id_ind'";
                    mysqli_query($con,$sql3);
                }else{
                    header("location:index.php");
                }

                $sql="SELECT * FROM upload WHERE id='$post_id_ind'";
                $select_post_id_content=mysqli_query($con, $sql);
                while($row= mysqli_fetch_array($select_post_id_content)){
                    $user_id = htmlspecialchars($row["id"]);
                    $username=htmlspecialchars($row["username"]);
                    $text = $row["post_text"];
                    $user_profile = htmlspecialchars($row["img"]);
                    $post_hit = htmlspecialchars($row["post_hit"]);
                    $post_date = htmlspecialchars($row["post_date"]);
                }
        ?>
            <section id="for-secont-post-margin">
            <div class="container">
                    <div class="row">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div id="post-for-shadow">
                                                    <div class="post-img">
                                                        <img id="post-img" src="img/<?php echo $user_profile?>">
                                                    </div>
                                                    <div class="post-content">
                                                        <div class="post-hit">
                                                            <i id="eye" class="fas fa-eye"><span><?php echo $post_hit?></span></i>
                                                            <i id="date"class="fas fa-clock"><span><?php echo $post_date?></span></i>
                                                        </div>
                                                        <div class="post-username">
                                                            <h2><?php echo $username ?></h2>
                                                        </div>
                                                        <div class="post-text">
                                                            <p><?php echo $text?></p>
                                                        </div>  
                                                    </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-3"></div>
                                    </div>
                                </div>
                            <?php include("includes/sidebar.php");?>
                        </div>
                    </div>
         </section>
                
           <!-- comment section           -->

           <?php
                    if(isset($_POST["create_comment"])){
                        $comment_author=htmlspecialchars($_POST["comment_author"]);
                        $comment_email=htmlspecialchars($_POST["comment_email"]);
                        $comment_text=htmlspecialchars($_POST["comment_text"]);

                        $sql4="INSERT INTO comments(comment_post_id,comment_author,comment_text,comment_email,comment_status,comment_date) VALUES 
                        ('$post_id_ind',' $comment_author','$comment_text','$comment_email','deny',now())";
                        mysqli_query($con,$sql4);
                        header("location:post.php");
                    }
           ?>

           <?php
                $sqlforfetch="SELECT * FROM comments WHERE comment_post_id='$post_id_ind'AND comment_status='accept'";
                $select_all_comment=mysqli_query($con,$sqlforfetch);
                $count_post_comment= mysqli_num_rows($select_all_comment);
            ?>

            <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                                <div class="blog-comments">
                                    <h4>(<?php echo $count_post_comment?>) Comments</h4>
                                </div>
                
                            <?php
                                while($row = mysqli_fetch_array($select_all_comment)){
                                    $comment_author = htmlspecialchars($row["comment_author"]);
                                    $comment_email = htmlspecialchars($row["comment_email"]);
                                    $comment_text = htmlspecialchars($row["comment_text"]);
                                    $comment_date = htmlspecialchars($row["comment_date"]);
                            ?>
                                    <div class="comments-for-post">
                                            <div class="comment-author">
                                            Name: <?php echo  $comment_author ?>
                                                <span>-<?php echo  $comment_date?>-</span>
                                            </div>
                                            <div class="comment-email">Email: <?php echo $comment_email?></div>
                                            <div class="comment-text"><?php echo $comment_text?></div>

                                    </div>

                                <?php } ?>
                        </div>
                        <div class="col-sm-6">
                        </div>
                    </div>
            </div>
                    
        
           

           


       <div class="form-mar">
            <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                                <div class="form-for-comment">
                                        <h3>Leave a comment</h3>
                                    <form action="" method="post">
                                        <div class="form-content">
                                                <div  class="class-group"><input id="comment_author" class="form-control" type="text" name="comment_author" placeholder="Your Name" required></div>
                                                <div class="class-group"><input id="comment_author" class="form-control"  type="email" name="comment_email" placeholder="Your Email" required></div>
                                                <div class="class-group"><textarea id="comment_author" class="form-control"  name="comment_text" placeholder="Write a comment" cols="15" rows="10" required></textarea></div>
                                        </div>
                                    
                                        <div class="class-group"><input id="submit"  class="form-control btn btn-success"  type="submit" name="create_comment" plceholder="comment"></div>

                                    </form>
                                </div>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                 </div> 
             </div>         
      
          
        
  <br/>  <br/>  <br/>  <br/>  <br/>
  </body>
</html>