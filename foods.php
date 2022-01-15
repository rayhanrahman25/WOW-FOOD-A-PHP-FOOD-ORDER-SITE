<?php include "./partials/menu.php" ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <?php  include "./partials/food-search.php" ?>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
             <?php
               $sql = "SELECT * FROM tbl_food WHERE active='YES' AND featured='YES' ORDER BY id DESC LIMIT 6";
               $res = mysqli_query($conn, $sql);
               $count = mysqli_num_rows($res);
               if($count > 0){
                   while($row = mysqli_fetch_assoc($res)){
                        
             ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/food/<?php echo $row['image_name'] ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $row['title']; ?></h4>
                    <p class="food-price"><?php echo $row['price']; ?> TK.</p>
                    <p class="food-detail">
                    <?php echo $row['description']; ?>
                    </p>
                    <br>

                    <a href="order.php?food_id=<?php echo $row['id']; ?>" class="btn btn-primary">Order Now</a>
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