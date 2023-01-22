<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
    ?>
<body>
    
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

    <div class="continer">
        <div class="row">
            
        </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>

</body>
</html>