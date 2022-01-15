<?php
include "partials/menu.php"; 
?>
        <!-- main-content -->
        <div class="main-content">
        <div class="wrapper">
        <h1> Manage Food</h1>
       <?php
          if(isset( $_SESSION['upload'])){
              echo  $_SESSION['upload'];
              unset( $_SESSION['upload']);
          }
       ?>
       <?php
          if(isset( $_SESSION['add'])){
              echo  $_SESSION['add'];
              unset( $_SESSION['add']);
          }
       ?>
       <?php
          if(isset( $_SESSION['delte-page-alert'])){
              echo  $_SESSION['delte-page-alert'];
              unset( $_SESSION['delte-page-alert']);
          }
       ?>
                <br/><br/> <br/>
                <a href="add-food.php" class="btn-primary">Add Food</a>
                <br/><br/><br/>
                <table class="tbl-width">
                         <tr>
                            <th>S.N</th>
                            <th>title</th>
                            <th>price</th>
                            <th>image</th>
                            <th>featured</th>
                            <th>Active</th>
                            <th>Actions</th>
                         </tr>
                         <?php
                          $sql = "SELECT * FROM tbl_food";
                          $res = mysqli_query($conn, $sql);
                          $count = mysqli_num_rows($res);
                          if($count > 0){ 
                                  $i=1;
                            while($row = mysqli_fetch_assoc($res)){
                         ?>
                         <tr>
                                 <td><?php echo $i++; ?></td>
                                 <td><?php echo $row['title']; ?></td>
                                 <td><?php echo $row['price']; ?></td>
                                 <td>
                                   <?php
                                    if($row['image_name'] != ""){
                                            ?>
                                        <img src="../images/food/<?php echo $row['image_name'] ?>" width="50" alt="">
                                            <?
                                    }else{
                                        echo "<div class='danger'>Image is not selected</div>";
                                    }
                                   ?>        
                                </td>
                                 <td><?php echo $row['featured'] ?></td>
                                 <td><?php echo $row['active'] ?></td>
                                 <td>
                                   <a href="update-food.php?id=<?php echo $row['id'] ?>" class="btn-secondary">Update Admin</a>
                                   <a href="delete-food.php?id=<?php echo $row['id']; ?>&image_name=<?php if(isset($row['image_name'])){echo $row['image_name'];  }?>" class="btn-danger">Delete Admin</a>
                                 </td>
                         </tr>
                         <?php
                          }
                        }else{
                            echo "<tr><td colspan='7' class='danger'>Food Not Added Yet</td></tr>" ;
                        }
                         ?>
                 </table>
                 
                 <div class="clearfix"></div>
             </div>
        </div>
<?php include "partials/footer.php";  ?>     