<?php include "./partials/menu.php" ?>

<?php
if(isset($_GET['food_id'])){
   $foodId = $_GET['food_id'];
   $sql = "SELECT * FROM tbl_food WHERE id='$foodId'";
   $res = mysqli_query($conn, $sql);
   $count = mysqli_num_rows($res);
   if($count == 1){
     $row = mysqli_fetch_assoc($res);

   }else{
    header('location:'.domain);
   }
}else{
 header('location:'.domain);
}

?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="images/food/<?php echo $row['image_name']; ?>" alt="<?php echo $row['title']; ?>" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $row['title'] ?></h3>
                        <input type="hidden" name="food-title" value="<?php echo $row['title']; ?>">
                        <p class="food-price"><?php echo $row['price'] ?> TK.</p>
                        <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Rayhan Rahman" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="0198***498" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="rayhan@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="221 B Beaker Street" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php
                if(isset($_POST['submit'])){
                     $food = $_POST['food-title'];
                     $price = $_POST['price'];
                     $qty = $_POST['qty'];
                     $total = $price * $qty;
                     $order_date = date("Y-m-d h:i:sa");
                     $status = "Ordered";
                     $customer_name = $_POST['full-name'];
                     $customer_contact = $_POST['contact'];
                     $customer_email = $_POST['email'];
                     $customer_address = $_POST['address'];

                     $sql2 = "INSERT INTO tbl_order SET food='$food', price='$price', qty='$qty', total='$total',
                              order_date='$order_date', status='$status', customer_name='$customer_name',
                               customer_contact='$customer_contact', customer_email='$customer_email',
                               customer_address='$customer_address'";
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2){
                        $_SESSION['order'] = "<div class='success text-center'>Your Food Ordered Successfully</div>";
                        header('location:'.domain);
                    }else{
                        $_SESSION['order'] = "<div class='danger'>Failed To Order Food</div>";
                        header('location:'.domain);
                    }

                }else{
                     
                }
                ?>
    <?php include "./partials/footer.php" ?>