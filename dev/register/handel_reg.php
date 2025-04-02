<?php
session_start();
extract($_POST);
require "../connect.php";
// print_r($_POST);
if (isset($_POST["add"])) {
    $errors = [];

    $image = $_FILES["image"];

    $imgName = $image["name"];

    $ext = pathinfo($imgName, PATHINFO_EXTENSION);

    $tmp = $image["tmp_name"];

    $error = $image["error"];

    $size = $image["size"] / (1024 * 1024);

    if (empty($Role)) {
        $errors["Role"] = "role is require";
    }

    if (empty($FName)) {
        $errors["FName"] = "First Name is require";
    } elseif (is_numeric($FName)) {
        $errors["FName"] = "First Name must be str";
    } elseif (strlen($FName) < 2) {
        $errors["FName"] = "First Name must be more than 3 letters";
    }

    if (empty($LName)) {
        $errors["LName"] = "Last Name is require";
    } elseif (is_numeric($LName)) {
        $errors["LName"] = "Last Name must be str";
    } elseif (strlen($LName) < 2) {
        $errors["LName"] = "Last Name must be more than 3 letters";
    }


    if (empty($Phone)) {
        $errors["Phone"] = "Phone is require";
    } elseif (!is_numeric($Phone)) {
        $errors["Phone"] = "Phone must be num";
    } elseif (strlen($Phone) > 12) {
        $errors["Phone"] = "Phone must be less than 12 letters";
    }


    if (empty($Email)) {
        $errors["Email"] = "Email is require";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $errors["Email"] = "the Email is un correct";
    } elseif (strlen($Email) < 5) {
        $errors["Email"] = "Email must be more than 5 letters";
    }

    if (empty($Password)) {
        $errors["Password"] = "Password is require";
    } elseif (!is_numeric($Password)) {
        $errors["Password"] = "Password must be num";
    } elseif (strlen($Password) < 5) {
        $errors["Password"] = "Password must be more than 5 letters";
    }
    if (empty($Confirm)) {
        $errors["Confirm"] = "Confirm Password is require";
    } elseif (!is_numeric($Confirm)) {
        $errors["Confirm"] = "Confirm Password must be num";
    } elseif (strlen($Confirm) < 5) {
        $errors["Confirm"] = "Confirm Password must be more than 5 letters";
    } elseif ($Password != $Confirm) {
        $errors["Confirm"] = "Confirm Password Not Like Password";
    }

    $ex = ["png", "jpg"];
    if (!in_array($ext, $ex)) {
        $errors["image"] = "image is req";
    }

    if (empty($errors)) {
        $ran_id = rand(0, 100000000);
        $status = "Active now";
        $newName = uniqid() . $imgName;
// 
        $pass =  md5($Password);
        $con_pass =  md5($Confirm);
        $query = "INSERT INTO users ( `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`, `Confirm`, `Role`, `Phone`)
VALUES('$ran_id', '$FName','$LName', '$Email', '$pass', '$newName', '$status','$con_pass' , '$Role', '$Phone')";
        $result = mysqli_query($connect, $query);

        if ($result) {
            move_uploaded_file($tmp ,"../../ChatApp - CodingNepal/php/images/$newName");
            header("location:../../login.php");
            $_SESSION["login"] = "login";
            $_SESSION["success"] = "Success Login";
        } else {
            header("location:../../register.php");
            print_r($errors);
        }
    } else {
        header("location:../../register.php");
        print_r($errors);
        $_SESSION["errors"] = $errors;
    }
}
