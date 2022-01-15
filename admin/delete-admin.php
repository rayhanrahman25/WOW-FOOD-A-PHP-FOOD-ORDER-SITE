<?php
include "../config/config.php";
$id = $_GET['deleteId'];
$sql = "DELETE FROM tbl_admin WHERE id='$id'";
$res = mysqli_query($conn,$sql);
if($res){
   $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
   header("location:http://127.0.0.1/wow-food/admin/manage-admin.php");
}else{
   $_SESSION['delete'] = "<div class='danger'>Failed To Delete Try Again Later</div>";
   header("location:http://127.0.0.1/wow-food/admin/manage-admin.php");

}