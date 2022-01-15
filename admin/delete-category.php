<?php
include "../config/config.php";
if(isset($_GET['id']) && isset($_GET['In'])){
    $id = $_GET['id'];
    $image_name = $_GET['In'];
    if($image_name != ""){
        $path = "../images/category/".$image_name;
        $remove = unlink($path);
        if($remove == false){
            $_SESSION['remove'] = "<div class='danger'>Failed To Remove Category Image</div>";
            header('location:'.domain.'admin/manage-category.php');
            die();
        }
    }
    $sql = "DELETE FROM tbl_category WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if($res){
        $_SESSION['remove'] = "<div class='success'>Category Deleted Successfully</div>";
        header('location:'.domain.'admin/manage-category.php');
    }else{
        $_SESSION['remove'] = "<div class='danger'>Failed to delete category</div>";
        header('location:'.domain.'admin/manage-category.php');
    }
}else{
    header('location:'.domain.'admin/manage-category.php');
}