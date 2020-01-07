<?php include("includes/connection.php"); ?>



<?php
    if(isset($_POST["action"])){

        $sql3= "SELECT * FROM upload ORDER BY id";
        $select_all_post=mysqli_query($con, $sql3);
        $total_row=mysqli_num_rows($select_all_post);
        $output = " ";
        if($total_row > 0){

            while($row= mysqli_fetch_array($select_all_post)){
                $user_id = htmlspecialchars($row["id"]);
                $username=htmlspecialchars($row["username"]);
                $text = $row["post_text"];
                $user_profile = htmlspecialchars($row["img"]);
                $post_hit = htmlspecialchars($row["post_hit"]);
                $post_date = htmlspecialchars($row["post_date"]);
             
                 $output .='  <div class="col-sm-6">
                                <div id="post-for-shadow">
                                            <div class="post-img">
                                            <img id="post-img" src="img/'.$user_profile.'">
                                        </div>
                                        <div class="post-content">
                                                <div class="post-hit">
                                                <i id="eye" class="fas fa-eye"><span>'.$post_hit.'</span></i>
                                                <i id="date"class="fas fa-clock"><span> '.$post_date.'</span></i>
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
        }

        echo $output;
    }
   
?>
