<?php
include "../config/config.php";
session_destroy();
header('location:http://127.0.0.1/wow-food/admin/login.php');