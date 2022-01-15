<?php
include "partials/menu.php"; 
?>
        <!-- main-content -->
        <div class="main-content">
        <div class="wrapper">
                <h1> Manage Order</h1>
                <br><br>
                <?php
                if(isset($_SESSION['order'])){
                  echo $_SESSION['order'];
                  unset($_SESSION['order']);
                }
                ?>
                <table style="width: 100%;"> 
                         <tr>
                                 <th>S.N</th>
                                 <th>Title</th>
                                 <th>Price</th>
                                 <th>Qty</th>
                                 <th>Total</th>
                                 <th>Order Date</th>
                                 <th>Status</th>
                                 <th>Customer Name</th>
                                 <th>Customer Email</th>
                                 <th>Customer Contact</th>
                                 <th>Customer Address</th>
                                 <th>Action</th>
                         </tr>
                         <?php 
                            $sn = 1;
                            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if($count > 0){
                               while($row = mysqli_fetch_assoc($res)){
                            ?>
                         <tr>
                                 <td><?php echo $sn++ ?></td>
                                 <td><?php echo $row['food']; ?></td>
                                 <td><?php echo $row['price']; ?></td>
                                 <td><?php echo $row['qty']; ?></td>
                                 <td><?php echo $row['total']; ?></td>
                                 <td><?php echo $row['order_date']; ?></td>
                                 <td>
                                   <?php
                                   $status = $row['status'];
                                   if($status == "Ordered"){
                                    echo "<b><label>$status</label></b>";
                                   }
                                   elseif($status == "On Delivery"){
                                    echo "<b><label style='color:orange;'>$status</label></b>";
                                   }
                                   elseif($status == "Delivered"){
                                    echo "<b><label style='color:green;'>$status</label></b>";
                                   }
                                   elseif($status == "Cancelled"){
                                    echo "<b><label style='color:red;'>$status</label></b>";
                                   }
                                   ?>
                                 </td>
                                 <td><?php echo $row['customer_name']; ?></td>
                                 <td><?php echo $row['customer_email']; ?></td>
                                 <td><?php echo $row['customer_contact']; ?></td>
                                 <td><?php echo $row['customer_address']; ?></td>
                                 <td>
                                   <a href="update-order.php?id=<?php echo $row['id']; ?>" class="btn-secondary">Update Order</a>
                                 </td>
                                
                         </tr>
                         <?php
                                  }
                                }
                                 ?>
                 </table>
                </div>
        </div>
<?php include "partials/footer.php";  ?>     