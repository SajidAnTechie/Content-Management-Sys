
<?php include("includes/connection.php");?>
<div class="col-sm-4">
        <div class="for-sibar-backgroud">
                <div class="widget">
			<div class="widget-search">
			        <input class="search-input form-control" type="text" placeholder="Search" id="search">
				<button class="search-btn" type="button"><i id="se" class="fas fa-search"></i></button>
			</div>
		</div>
                    <div class="for-categories">
                            <h3>Categories</h3>
                            <div class="category">
                                <?php
                                        $sql="SELECT * FROM category";
                                        $elect_all_cat=mysqli_query($con,$sql);
                                        while($row=mysqli_fetch_array($elect_all_cat)){
                                                $category_name=htmlspecialchars($row["Category_Name"]);
                                                $sql2="SELECT * FROM upload WHERE category='$category_name'";
                                                $select_all_post_cat=mysqli_query($con,$sql2);
                                                $count_category=mysqli_num_rows($select_all_post_cat);
                                        ?>
                                                <div class="category-name">
                                                        <a id="link-for-category" href="categories.php?categoryname=<?php echo $category_name?>"><?php echo $category_name ?></a>
                                                        <span id="for-link-span">(<?php echo  $count_category?>)</span>
                                                </div>
                                        <?php } ?>
                            </div>
                            
                    </div>
        </div>
</div>