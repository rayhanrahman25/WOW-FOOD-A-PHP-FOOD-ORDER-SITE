<?php include "./partials/menu.php" ?>
<?php
 if(isset($_GET['category_id'])){
     $cat_id = $_GET['category_id']; 
 }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
              $sql2 = "SELECT * FROM tbl_category WHERE id='$cat_id'";
              $res2 = mysqli_query($conn, $sql2);
              $row2 = mysqli_fetch_assoc($res2);
            ?>
            <h2>Foods on <a href="#" class="text-white">"<?php echo  $row2['title']; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
             <?php
             
             $sql = "SELECT * FROM tbl_food WHERE category_id='$cat_id'";
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

                    <a href="order.php?food_id=<?php echo $row2['id']; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <?php
             }
            }else{
                echo "<div class='danger text-center'>We Found Noting Based On This Name</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include "./partials/footer.php" ?>