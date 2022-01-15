<?php
 include "../config/config.php"; 

if(isset($_GET['id']) && isset($_GET['image_name'])){
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    if($image_name != ""){
        $path = "../images/food/".$image_name;
        $remove = unlink($path);
        if($remove==false){
            $_SESSION['delete-page-alert'] = "<div class='danger'>Failed To Remove Image</div>";
            header('location:'.domain.'admin/manage-food.php');
            die();
        }
    }
    $sql = "DELETE FROM tbl_food WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if($res){
        $_SESSION['delte-page-alert'] = "<div class='success'>Record Deleted Successfully</div>";
        header('location:'.domain.'admin/manage-food.php');
    }else{
        $_SESSION['delte-page-alert'] = "<div class='danger'>Something Wrong With Your Code ! Please Check</div>";
        header('location:'.domain.'admin/manage-food.php');
    }

}else{
    $_SESSION['delte-page-alert'] = "<div class='danger'>Unauthorized Access</div>";
    header('location:'.domain.'admin/manage-food.php');
}


