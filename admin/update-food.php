<?php include "partials/menu.php"; ?>
<?php
 if(isset($_GET['id'])){
     $id = $_GET['id'];
     $sql2 = "SELECT * FROM tbl_food WHERE id='$id'";
     $res2 = mysqli_query($conn, $sql2);
     $row2 = mysqli_fetch_assoc($res2);
 }
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <form action="#" method="POST" enctype="multipart/form-data">
         <table class="tbl-30">
         <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $row2['title']; ?>"></td>
                </tr><br><br>
                
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" ><?php echo $row2['description']; ?></textarea></td>
                </tr>
                   <tr>
                       <td>Price: </td>
                       <td><input type="number" name="price" value="<?php echo $row2['price'] ?>"></td>
                   </tr>
                   <tr>
                       <td>Current Image: </td>
                       <td><img width="50" src="../images/food/<?php echo $row2['image_name']  ?>" alt=""></td>
                   </tr>
                   <tr>
                       <td>Update Image: </td>
                       <td><input type="file" name="img" ></td>
                   </tr>
                   <tr>
                       <td> Category: </td>
                       <td>
                           <select name="category">
                               <?php
                                $sql = "SELECT * FROM tbl_category WHERE active='YES'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if($count > 0){
                                  while($row = mysqli_fetch_assoc($res)){
                               ?>
                               <option <?php if($row['id'] ==  $row['id']){echo "Selected";} ?> value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option>
                               <?php
                                       
                                    }
                                }else{
                                    ?>
                                <option value="0">No Category Found</option>
                                    <?
                                }
                               ?>
                           </select>
                       </td>
                   </tr>
                   <tr>
                       <td>Active</td>
                        <td>
                           <input <?php if($row2['active']=="YES"){echo "checked";} ?>  type="radio" name="active" value="YES"> YES
                           <input <?php if($row2['active']=="NO"){echo "checked";} ?> type="radio" name="active" value="NO"> NO
                        </td>
                   </tr>
                   <tr>
                       <td>Featured</td>
                        <td>
                           <input <?php if($row2['featured']=="YES"){echo "checked";} ?> type="radio" name="featured" value="YES"> YES
                           <input <?php if($row2['featured']=="NO"){echo "checked";} ?> type="radio" name="featured" value="NO"> NO
                        </td>
                   </tr>
                   <tr>
                       <td colspan="2">
                           <input type="hidden" name="id" value="<?php echo $row2['id'] ?>">
                           <input type="hidden" name="current_img" value="<?php echo $row2['image_name'] ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                       </td>
                   </tr>
         </table>
        </form>
        <?php
           if(isset($_POST['submit'])){
               $id = $_POST['id'];
               $title = $_POST['title'];
               $description = $_POST['description'];
               $price = $_POST['price'];
               $current_image = $_POST['current_img'];
               $category = $_POST['category'];
               $featured = $_POST['featured'];
               $active = $_POST['active'];
               if(isset($_FILES['img']['name'])){
                   $image_name = $_FILES['img']['name'];
                   if($image_name != ""){
                       $ext = end(explode('.',$image_name));
                       $image_name = "wow-food".rand(0,9999999).".".$ext;
                       $src = $_FILES['img']['tmp_name'];
                       $dist = "../images/food".$image_name;
                       $upload = move_uploaded_file($src, $dist);
                       if($upload==false){
                        $_SESSION['upload'] = "<div class='danger'>Image Upload Fail</div>";
                        header('location:'.domain.'admin/manage-food.php');
                        die();  
                       }
                       if($current_image != ""){
                           $remove_img = "../images/food".$image_name;
                           $remove = unlink($remove_img);
                           if($remove == false){
                            $_SESSION['upload'] = "<div class='success'>Remove Image Failed</div>";
                            header('location:'.domain.'admin/manage-food.php'); 
                            die();
                           }
                       }
                   }else{
                    $image_name = $current_image; 
                   }
               }else{
                   $image_name = $current_image;
               }
               $sql3 = "UPDATE tbl_food SET title='$title', description='$description', price='$price', image_name='$image_name', category_id='$category', featured='$featured', active='$active' WHERE id='$id'";
               $res3 = mysqli_query($conn, $sql3);
               if($res3){
                $_SESSION['upload'] = "<div class='success'>Reupdate Food Successfully</div>";
                header('location:'.domain.'admin/manage-food.php');  
               }else{
                $_SESSION['upload'] = "<div class='danger'>Reupdate Failed</div>";
                header('location:'.domain.'admin/manage-food.php');  
               }
           }
        ?>
    </div>
</div>
<?php include "partials/footer.php"; ?>