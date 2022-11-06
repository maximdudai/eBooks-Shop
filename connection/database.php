<?php 

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "shop";

    $sql = mysqli_connect($hostname, $username, $password, $database) OR die("An mysql error: ").mysqli_connect_error();
    mysqli_set_charset($sql, 'utf8');
?>