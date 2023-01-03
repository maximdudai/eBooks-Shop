<?php 
    error_reporting(0);
    include("../../connection/database.php");

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        $book_id = $_GET['book_id'];
        $user_id = $_GET['user_id'];
        
        mysqli_query($sql, "DELETE FROM `user_cart` WHERE `book_id` = '$book_id' AND `user_id` = '$user_id'");
        
        header("Location: ./user_cart.php");
        die();
    }
?>