<?php include "./partials/menu.php" ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <?php  include "./partials/food-search.php" ?>

    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <?php
      if(isset($_SESSION['order'])){
          echo $_SESSION['order'];
          unset($_SESSION['order']);
      }
    ?>
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
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

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
             <?php
               $sql2 = "SELECT * FROM tbl_food WHERE active='YES' AND featured='YES' ORDER BY id DESC LIMIT 6";
               $res2 = mysqli_query($conn, $sql2);
               $count = mysqli_num_rows($res2);
               if($count > 0){
                   while($row2 = mysqli_fetch_assoc($res2)){
                        
             ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/food/<?php echo $row2['image_name'] ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $row2['title']; ?></h4>
                    <p class="food-price"><?php echo $row2['price']; ?> TK.</p>
                    <p class="food-detail">
                    <?php echo $row2['description']; ?>
                    </p>
                    <br>

                    <a href="order.php?food_id=<?php echo $row2['id']; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
             <?php
                }
            }else{
                echo "<div class='danger'>No Foods Available To Show</div>";
            }
             ?>
               <div class="clearfix"></div>
            </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include "./partials/footer.php" ?>