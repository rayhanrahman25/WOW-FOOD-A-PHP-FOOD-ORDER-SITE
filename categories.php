<?php include "./partials/menu.php" ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Food Categories</h2>
            <?php
              $sql = "SELECT * FROM tbl_category WHERE active='YES' AND featured='YES' ORDER BY id DESC  LIMIT 6";
              $res = mysqli_query($conn,$sql);
              $count = mysqli_num_rows($res);
               if($count > 0){
                  while($row = mysqli_fetch_assoc($res)){
                      
            ?>
            <a href="category-foods.php?category_id=<?php echo $row['id']; ?>">
            <div class="box-3 float-container">
                <img src="images/category/<?php echo $row['image_name']; ?>" alt="<?php echo $row['title'] ?>" class="img-responsive img-curve">

                <h3 class="float-text text-white"><?php echo $row['title']; ?></h3>
            </div>
            </a>
             <?php
                  }
                }else{
                    echo "<div class='error'>Category Not Added</div>";
                }
                
             ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- social Section Starts Here -->
    <?php include "./partials/footer.php" ?>