<?php include "partials/menu.php"; ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
      
        <form action="#" method="POST">
          <table class="tbl-30">
              <tr>
                  <td>Full Name:</td>
                  <td>
                  <input type="text" name="full_name" placeholder="Enter Your Name">
                  </td>
              </tr>
              <tr>
                  <td>Username:</td>
                  <td>
                  <input type="text" name="username" placeholder="Your Username">
                  </td>
              </tr>
              <tr>
                  <td>Password:</td>
                  <td>
                  <input type="password" name="password" placeholder="New Admin Password">
                  </td>
              </tr>
              <tr>
                  <td colspan="2">
                  <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                  </td>
              </tr>
          </table>
        </form>
    </div>
</div>
<?php include "partials/footer.php";  ?>    
<?php
if(isset($_POST['submit'])){
  $FullName = $_POST['full_name'];
  $UserName = $_POST['username'];
  $Password = md5($_POST['password']);
  $sql = "INSERT INTO tbl_admin SET full_name='$FullName', username='$UserName', password='$Password'";
  $res = mysqli_query($conn, $sql);
  if($res){
   $_SESSION['add'] = "Admin Added Successfully";
   header("location:http://127.0.0.1/wow-food/admin/manage-admin.php");
  }else{
    $_SESSION['add'] = "Something Went Wrong There";
    header("location:http://127.0.0.1/wow-food/admin/manage-admin.php");  
  }
}
?>