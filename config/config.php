<?php
define('domain','http://127.0.0.1/wow-food/');
session_start();

$host = "127.0.0.1";
$username = "root";
$password = "mysql";
$database = "wow-food";

$conn = mysqli_connect($host,$username,$password,$database);
if(!$conn){
    die("<script>alert('database connection failed')</script>");
}