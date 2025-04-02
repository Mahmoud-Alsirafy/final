<?php
session_start();
$id = $_GET["id"];
require "../connect.php";
$query = "DELETE FROM `mess` WHERE id='$id'";
$result = mysqli_query($connect, $query);
if ($result) {
    header("location:../../message.php");
    $_SESSION["delete"] = "Success Deleted Message";
}
