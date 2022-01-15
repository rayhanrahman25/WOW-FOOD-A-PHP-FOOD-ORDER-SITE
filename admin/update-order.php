<?php include "partials/menu.php" ?>
<?php
  if(isset($_GET['id'])){
     $id = $_GET['id'];
     $sql = "SELECT * FROM tbl_order WHERE id='$id'";
     $res = mysqli_query($conn, $sql);
     if($res){
           $row = mysqli_fetch_assoc($res);
     }else{
         header('location:'.domain.'admin/manage-order.php');
     }
  }else{
      header('location:'.domain.'admin/manage-order.php');
  }
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        <form action="" method="POST">
         <table class="tbl-30">
             <tr>
                 <td>Food Name</td>
                 <td><b><?php echo $row['food']; ?></b></td>
             </tr>
             <tr>
                 <td>Price</td>
                 <td><?php echo $row['price']; ?></td>
             </tr>
             <tr>
                 <td>Qty</td>
                 <td>
                    <input type="number" name="qty" value="<?php echo $row['qty']; ?>">
                 </td>
             </tr>
             <tr>
                 <td>Status</td>
                 <td>
                     <select name="status">
                         <option <?php if($row['status']=="Ordered"){ echo "Selected" ;} ?> value="Ordered">Ordered</option>
                         <option <?php if($row['status']=="On Delivery"){ echo "Selected" ;} ?> value="On Delivery">On Delivery</option>
                         <option <?php if($row['status']=="Delivered"){ echo "Selected" ;} ?> value="Delivered">Delivered</option>
                         <option <?php if($row['status']=="Cancelled"){ echo "Selected" ;} ?> value="Cancelled">Cancelled</option>
                     </select>
                 </td>
             </tr>
             <tr>
                 <td>Customer Name: </td>
                 <td><input type="text" name="customer_name" value="<?php echo $row['customer_name'] ?>"></td>
             </tr>
             <tr>
                 <td>Customer Contact: </td>
                 <td><input type="text" name="customer_contact" value="<?php echo $row['customer_contact'] ?>"></td>
             </tr>
             <tr>
                 <td>Customer Email: </td>
                 <td><input type="text" name="customer_email" value="<?php echo $row['customer_email'] ?>"></td>
             </tr>
             <tr>
                 <td>Customer Address: </td>
                 <td><input type="text" name="customer_address" value="<?php echo $row['customer_address'] ?>"></td>
             </tr>
             <tr>
                 <td colspan="2">
                     <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                     <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                 <input type="submit" class="btn-primary" name="submit" value="Update Order">
                 </td>
             </tr>
            
         </table>
        </form>
    </div>
</div>
<?php
 if(isset($_POST['submit'])){
     $id = $_POST['id'];
     $price = $_POST['price'];
     $qty = $_POST['qty'];
     $total = $price * $qty ;
     $status = $_POST['status'];
     $customer_name = $_POST['customer_name'];
     $customer_contact = $_POST['customer_contact'];
     $customer_email = $_POST['customer_email'];
     $customer_address = $_POST['customer_address'];

     $sql2 = "UPDATE tbl_order SET price='$price', qty='$qty',total='$total',status='$status', customer_name='$customer_name',
              customer_contact='$customer_contact', customer_email='$customer_email', customer_address='$customer_address' WHERE id='$id'";
     $res2 = mysqli_query($conn, $sql2);
     if($res2){
      $_SESSION['order'] =  "<div class='success'>Order Update Successfully</div>";
      header('location:'.domain.'admin/manage-order.php');
     }else{
        $_SESSION['order'] =  "<div class='success'>Order Update Failed</div>";
         header('location:'.domain.'admin/manage-order.php');
     }   
 }
?>
<?php include "partials/footer.php" ?>