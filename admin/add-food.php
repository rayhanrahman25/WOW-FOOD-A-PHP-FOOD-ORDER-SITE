<?php  include "partials/menu.php"; ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <form action="#" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Title of the food"></td>
                </tr><br><br>
                
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="food description"></textarea></td>
                </tr>
                   <tr>
                       <td>Price: </td>
                       <td><input type="number" name="price" ></td>
                   </tr>
                   <tr>
                       <td>Food Image: </td>
                       <td><input type="file" name="food-img" ></td>
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
                               <option value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option>
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
                           <input type="radio" name="active" value="YES"> YES
                           <input type="radio" name="active" value="NO"> NO
                        </td>
                   </tr>
                   <tr>
                       <td>Featured</td>
                        <td>
                           <input type="radio" name="featured" value="YES"> YES
                           <input type="radio" name="featured" value="NO"> NO
                        </td>
                   </tr>
                   <tr>
                       <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                       </td>
                   </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['submit'])){
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            if(isset($_POST['featured'])){
             $featured = $_POST['featured'];
            }else{
            $featured = "NO";
            }
            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }else{
                $active = "NO";
            }
            if(isset($_FILES['food-img']['name'])){
                $image_name = $_FILES['food-img']['name'];
                if($image_name != ""){
                    $ext = end(explode('.',$image_name));
                    $image_name = "wow-food-".rand(0,99999999).".".$ext;
                    $src = $_FILES['food-img']['tmp_name'];
                    $dst = "../images/food/".$image_name;
                    $upload = move_uploaded_file($src, $dst);
                    if($upload==false){
                        $_SESSION['upload'] = "<div class'success'>Image Upload Failed</div>";
                        header('location:'.domain.'admin/manage-food.php');
                        die();
                    }
                }  
            }else{
                $image_name = "";
            }
            $sql2 = "INSERT INTO tbl_food SET title='$title', description='$description', price='$price', image_name='$image_name', category_id='$category', featured='$featured', active='$active'";
            $res2 = mysqli_query($conn, $sql2);
            if($res2){
                $_SESSION['add'] = "<div class'success'>Food Added Successfully</div>";
                header('location:'.domain.'admin/manage-food.php');
            }else{
                $_SESSION['add'] = "<div class'danger'>Failed To Add Food</div>";
                header('location:'.domain.'admin/manage-food.php'); 
            }
        }
        ?>
    </div>
</div>
<?php  include "partials/footer.php"; ?>