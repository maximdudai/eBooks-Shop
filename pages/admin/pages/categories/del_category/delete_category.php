<?php 
    // error_reporting(0);
   include($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        $category_id = $_GET['category_id'];
        
        mysqli_query($sql, "DELETE FROM `categories` WHERE `ID` = '$category_id'");

        header("Location: ./category.php");
        die();
    }
?>