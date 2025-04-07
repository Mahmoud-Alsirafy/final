<?php
session_start();
extract($_POST);
require "../connect.php";
// print_r($_POST);
if (isset($_POST["add"])) {
    $errors = [];
    
    if (empty($Name)) {
        $errors["Name"] = "Name is require";
    } elseif (is_numeric($Name)) {
        $errors["Name"] = "Name must be str";
    } elseif (strlen($Name) < 2) {
        $errors["Name"] = "Name must be more than 3 letters";
    }   


   


    if (empty($Email)) {
        $errors["Email"] = "Email is require";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $errors["Email"] = "the Email is un correct";
    } elseif (strlen($Email) < 5) {
        $errors["Email"] = "Email must be more than 5 letters";
    }

    if (empty($Subject)) {
        $errors["Subject"] = "Subject is require";
    } elseif (is_numeric($Subject)) {
        $errors["Subject"] = "Subject must be str";
    } elseif (strlen($Subject) < 2) {
        $errors["Subject"] = "Subject must be more than 3 letters";
    }  

    if (empty($Message)) {
        $errors["Message"] = "Message is require";
    } elseif (is_numeric($Message)) {
        $errors["Message"] = "Message must be str";
    } elseif (strlen($Message) < 2) {
        $errors["Message"] = "Message must be more than 3 letters";
    }  


    if (empty($errors)) {
        $query = "INSERT INTO `mess`
        (`Name`, `Email`, `Subject`, `message`)
         VALUES 
        ('$Name','$Email','$Subject','$Message')";
        $result = mysqli_query($connect, $query);

        if ($result) {
           header("location:../../index.php");
           $_SESSION["message"]="Success Send Message";
        }else {
            header("location:../../index.php");
        }
    } else {
        header("location:../../index.php");
        // print_r($errors);
        $_SESSION["errors"] = $errors;
    }


}




?>