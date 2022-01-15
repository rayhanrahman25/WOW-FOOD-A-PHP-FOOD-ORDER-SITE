<?php
include "../config/config.php";
if(!isset($_SESSION['user'])){
    header('location:http://127.0.0.1/wow-food/admin/login.php');
}
?>
<html>
    <head>
        <title>Wow Food - Order Your Food Instant</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <!-- menu -->
        <div class="menu text-center">
             <div class="wrapper">
               <ul>
                   <li><a href="index.php">Home</a></li>
                   <li><a href="manage-admin.php">Admin</a></li>
                   <li><a href="manage-category.php">Category</a></li>
                   <li><a href="manage-food.php">Food</a></li>
                   <li><a href="manage-order.php">Order</a></li>
                   <li><a href="logout.php">Logout</a></li>
               </ul>
             </div>
        </div>