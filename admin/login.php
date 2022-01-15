<?php include "../config/config.php" ;?>
<html>
    <head>
        <title>Login - Wow Food</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <?php
             if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>
            <h1 class="text-center">Login</h1>
            <form action="#" method="POST">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password: <br>
                <input type="password" class="mx-auto" name="password" placeholder="Enter Password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>
            <p class="text-center">Created By - <a href="#">Rayhan Rahman</a></p>
        </div>
    </body>
</html>
<?php
if(isset($_POST['submit'])){
   $userName = $_POST['username'];
    $passWord = md5($_POST['password']);
    $sql = "SELECT * FROM tbl_admin WHERE username='$userName' AND password='$passWord'";
    $res = mysqli_query($conn, $sql);
    if($res){
        $count = mysqli_num_rows($res);
        if($count==1){
         $_SESSION['login'] = "<div class='success'>Login Successfull</div>";
         $_SESSION['user'] = $userName;
         header('location:http://127.0.0.1/wow-food/admin/');
        }else{
            $_SESSION['login'] = "<div class'danger'>Login Failed ( username or password didn't match )</div>";
            header('location:http://127.0.0.1/wow-food/admin/login.php');
        }
    }else{
        $_SESSION['login'] = "<div class='danger'>Login Failed ( username or password didn't match )</div>";
    }
}
?>
