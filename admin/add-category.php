<?php include "partials/menu.php"; ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <?php
         if(isset($_SESSION['add'])){
             echo $_SESSION['add'];
             unset($_SESSION['add']);
         }
         if(isset($_SESSION['error'])){
             echo $_SESSION['error'];
             unset($_SESSION['error']);
         }
        ?>
        <br><br>
        <form action="#" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input  type="radio" name="featured" value="YES"> Yes
                        <input  type="radio" name="featured" value="NO"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="YES"> Yes
                        <input type="radio" name="active" value="NO"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                      <input type="submit" name="submit" value="Add Category" class="btn-secondary"> 
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST['submit']) && isset($_POST['title'])){
    $title = $_POST['title'];
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
    if(isset($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];
        $ext = end(explode('.',$image_name));
        $image_name = "wow-food-".rand(0,999999999).".".$ext;
        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/".$image_name;
        $upload = move_uploaded_file($source_path, $destination_path);
        if(!$upload){
          $_SESSION['error'] = "<div class='danger'>Failed To Upload Image</div>";
          header('lcoation'.domain.'admin/add-category.php');
          die();
        }
    }else{
        $image_name = "";
    }
   
    $sql = "INSERT INTO tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active'";
    $res = mysqli_query($conn, $sql);
    if($res){
        $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
        header('location:'.domain.'admin/manage-category.php');
    }else{
        $_SESSION['add'] = "<div class='danger'>Failed To Add Category</div>";
        header('location:'.domain.'admin/add-category.php');
    }
}
?>
<?php include "partials/footer.php"; ?>
