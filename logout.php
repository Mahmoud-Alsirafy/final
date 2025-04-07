<?php 
session_start();

unset($_SESSION["login"]);
unset($_SESSION["success"]);

header("location:login.php");