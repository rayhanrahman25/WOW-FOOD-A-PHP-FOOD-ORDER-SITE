<?php include "partials/menu.php"; ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_category WHERE id='$id'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count==1){
                   $row = mysqli_fetch_assoc($res);

                }else{
                    $_SESSION['no-category-found'] = "<div class='danger'>Category Not Found </div>";
                    header('location:'.domain.'admin/manage-category.php');
                }
            }
        ?>
        <form action="#" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $row['title']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                      <?php
                        if($row['image_name'] != ""){
                         ?>
                         <img src="../images/category/<?php echo $row['image_name']?>" width="50" alt="">
                         <?php
                        }else{
                            echo "<div class='danger'>Image Not Added</div>";
                        }
                      ?>
                    </td>
                </tr>
                <tr>
                    <td> New Image:</td>
                    <td>
                       <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td> Featured: </td>
                    <td>
                       <input <?php if($row['featured']=="YES"){echo "checked";} ?> type="radio" name="featured" value="YES"> YES
                       <input <?php if($row['featured']=="NO"){echo "checked";} ?> type="radio" name="featured" value="NO"> NO
                    </td>
                </tr>
                <tr>
                    <td> Active: </td>
                    <td>
                       <input <?php if($row['active']=="YES"){echo "checked";} ?> type="radio" name="active" value="YES"> YES
                       <input <?php if($row['active']=="NO"){echo "checked";} ?> type="radio" name="active" value="NO"> NO
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $row['image_name']; ?>">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
         if($_POST['submit']){
             $title = $_POST['title'];
             $id = $_POST['id'];
             $current_img = $_POST['current_image'];
             $featured = $_POST['featured'];
             $active = $_POST['active'];
             
              
             //---------------- updating  Image ----------------------
             if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];
                    if($image_name != ""){
                        $ext = end(explode('.',$image_name));
                        $image_name = "wow-food-".rand(0,999999999).".".$ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);
                        if($upload==false){
                          $_SESSION['add'] = "<div class='danger'>Failed To Upload Image</div>";
                          header('lcoation'.domain.'admin/manage-category.php');
                          die();
                        }else{
                            if($current_img != ""){
                                $remove_path = "../images/category/".$current_img;
                                $remove = unlink($remove_path);
                                if($remove==false){
                                    $_SESSION['add'] = "<div class='danger'>Failed To Remove Image</div>";
                                    header('lcoation'.domain.'admin/manage-category.php');
                                }
                            } 
                        }
                    }else{
                       
                        $image_name = $current_img;
                       
                    }
             }else{
              $image_name = $current_img;   
             }

             $sql2 = "UPDATE tbl_category SET title='$title', featured='$featured', image_name='$image_name', active='$active' WHERE id='$id'";
             $res2 = mysqli_query($conn, $sql2);
             if($res2){
                  $_SESSION['add'] = "<div class='success'>Category Updated Successfully</div>";
                  header('location:'.domain.'admin/manage-category.php');
             }else{
                 
             }
         }
        ?>
    </div>
</div>
<?php include "partials/footer.php"; ?>