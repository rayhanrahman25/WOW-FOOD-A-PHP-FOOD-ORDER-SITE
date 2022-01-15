<?php

include "partials/menu.php"; 
?>
        <!-- main-content -->
        <div class="main-content">
        <div class="wrapper">
                <h1> Manage Admin</h1>
                <br/><br/> <br/>
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br/><br/><br/>
                <span>
                  <?php
                   if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                   }
                   if(isset($_SESSION['delete'])){
                     echo $_SESSION['delete'];
                     unset($_SESSION['delete']);    
                   }
                   if(isset($_SESSION['update'])){
                     echo $_SESSION['update'];
                     unset($_SESSION['update']);    
                   }
                   if(isset($_SESSION['user_not_found'])){
                     echo $_SESSION['user_not_found'];
                     unset($_SESSION['user_not_found']);    
                   }
                   if(isset($_SESSION['password_related'])){
                     echo $_SESSION['password_related'];
                     unset($_SESSION['password_related']);    
                   }
                ?>
                </span>
                <br/><br/> <br/>
                 <table class="tbl-width">
                         
                         <tr>
                                 <th>S.H</th>
                                 <th>Full Name</th>
                                 <th>Username</th>
                                 <th>Action</th>
                         </tr>
                         <?php
                         $sql = "SELECT * FROM tbl_admin";
                         $res = mysqli_query($conn, $sql);
                         if($res){
                               
                           while($row = mysqli_fetch_assoc($res)){
                         ?>
                         <tr>
                                 <td><?php echo $row['id'] ?></td>
                                 <td><?php echo $row['full_name'] ?></td>
                                 <td><?php echo $row['username'] ?></td>
                                 <td>
                                  <a href="update-password.php?id=<?php echo $row['id'] ?>" class="btn-primary">Change Password</a>
                                   <a href="update-admin.php?uID=<?php echo $row['id'] ?>" class="btn-secondary">Update Admin</a>
                                   <a href="delete-admin.php?deleteId=<?php echo $row['id']; ?>" class="btn-danger">Delete Admin</a>
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