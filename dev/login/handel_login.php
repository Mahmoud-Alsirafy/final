<?php
session_start();
require "../connect.php";

extract($_POST);
print_r($_POST);

$query = "SELECT * FROM `users` WHERE email = '$Email'";

$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) == 1) {
  $user = mysqli_fetch_assoc($result);



  $pass_user = $user["password"];
  
  $user_pass = md5($Password);

  if ($pass_user === $user_pass) {
    header("location:../../index.php");
  }else{
    header("location:../../login.php");
    $_SESSION["user"]="User Or Password Is Un Correct";
    
  }
}else{
    header("location:../../login.php");
    $_SESSION["user"]="User Or Password Is Un Correct";
  }



?>