<?php 

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');

    function displayImageFromDatabase($con, $b_id){
        $getBookImage = "SELECT img_url, img_name FROM `stock` WHERE `ID` = '$b_id'";
        $queryBookImage = mysqli_query($con, $getBookImage);

        $imageInfo = mysqli_fetch_assoc($queryBookImage);

        return '<img class="img-fluid" style="min-width: 15rem;" src=data:image;base64,'.$imageInfo['img_url'].' alt="'.$imageInfo['img_name'].'"/>';
    }
    
?>