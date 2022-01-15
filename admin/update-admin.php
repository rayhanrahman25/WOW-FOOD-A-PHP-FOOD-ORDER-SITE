<?php include "partials/menu.php"; ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
         $id = $_GET['uID'];
         $sql = "SELECT * FROM tbl_admin WHERE id='$id'";
         $res = mysqli_query($conn,$sql);
         if($res){
             $count = mysqli_num_rows($res);
             if($count==1){
               $row = mysqli_fetch_assoc($res);
               $userName = $row['username'];
               $fullName = $row['full_name'];
             }else{
                 header('location:http://127.0.0.1/wow-food/admin/manage-admin.php');
             }
         }
        ?>
        <form action="" method="POST">
        <table class="tbl-30">
              <tr>
                  <td>Full Name:</td>
                  <td>
                  <input type="text" name="full_name" placeholder="Enter Your Name" value="<?php echo $fullName ?>">
                  </td>
              </tr>
              <tr>
                  <td>Username:</td>
                  <td>
                  <input type="text" name="username" placeholder="Your Username" value="<?php echo $userName ?>">
                  </td>
              </tr>
              <tr>
                  <td colspan="2">
                      <input type="hidden" name="id" value="<?php echo $id ?>">
                  <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                  </td>
              </tr>
          </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $fullName = $_POST['full_name'];
    $userName = $_POST['username'];
    $sql = "UPDATE tbl_admin SET full_name='$fullName', username='$userName' WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if($res){
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
        header('location:http://127.0.0.1/wow-food/admin/manage-admin.php');
    }else{
        $_SESSION['update'] = "<div class='danger'>Something Went Wrong Please Try Again</div>";
        header('location:'.domain.'/admin/manage-admin.php');
    }
}
?>
<?php include "partials/footer.php"; ?>