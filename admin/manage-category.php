<?php
include "partials/menu.php"; 
?>
        <!-- main-content -->
        <div class="main-content">
        <div class="wrapper">
                <h1>Manage Category</h1>
                <?php
         if(isset($_SESSION['add'])){
             echo $_SESSION['add'];
             unset($_SESSION['add']);
         }
        ?>
                <?php
         if(isset($_SESSION['remove'])){
             echo $_SESSION['remove'];
             unset($_SESSION['remove']);
         }
        ?>
                <?php
         if(isset($_SESSION['no-category-found'])){
             echo $_SESSION['no-category-found'];
             unset($_SESSION['no-category-found']);
         }
        ?>
                <br/><br/> <br/>
                
                <a href="add-category.php" class="btn-primary">Add Category</a>
                <br/><br/><br/>
                <table class="tbl-width">
                         
                         <tr>
                                 <th>S.H</th>
                                 <th>Title</th>
                                 <th>Image</th>
                                 <th>Featured</th>
                                 <th>Active</th>
                                 <th>Action</th>
                         </tr>
                         <?php
                           $sql = "SELECT * FROM tbl_category";
                           $res = mysqli_query($conn, $sql);
                           $count = mysqli_num_rows($res);
                           if($count>0){
                                $serial = 1;
                            while($row = mysqli_fetch_assoc($res)){

                         ?>
                         <tr>
                                 <td><?php echo $serial++ ?></td>
                                 <td><?php echo $row['title']; ?></td>
                                 <td><img src="../images/category/<?php echo $row['image_name']; ?>" width="50" alt=""></td>
                                 <td><?php echo $row['featured']; ?></td>
                                 <td><?php echo $row['active']; ?></td>
                                 <td>
                                   <a href="update-category.php?id=<?php echo $row['id'] ?>" class="btn-secondary">Update Category</a>
                                   <a href="delete-category.php?id=<?php echo $row['id'] ?>&In=<?php echo $row['image_name']; ?>" class="btn-danger">Delete Category</a>
                                 </td>
                         </tr>
                         <?php
                            }
                        }else{

                        }
                         ?>
                 </table>
                
             </div>
        </div>
<?php include "partials/footer.php";  ?>     