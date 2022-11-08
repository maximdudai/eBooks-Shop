<?php 
    error_reporting(0);
    include("../../connection/database.php");

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        $book_id = $_GET['book_id'];
        $user_id = $_GET['user_id'];
        
        mysqli_query($sql, "DELETE FROM `favorites` WHERE `bookID` = '$book_id' AND `userID` = '$user_id'");
        
        header("Location: ./add_to_cart.php");
        die();
    }
?>