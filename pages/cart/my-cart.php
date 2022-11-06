<?php error_reporting(E_ERROR | E_PARSE);
    include('../../connection/database.php');
    session_start();
?>

<style>
    .notification {
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translate(-50%, -50%);
        margin: 0 auto;
        z-index: 2025;
    }
    .app {
        background-color: #80669d;
        width: 15rem;
        height: 5rem;
    }
</style>


<!DOCTYPE html>
<html lang="en">
    <?php 
        require('../../components/head.php');
        
        require('my-cart-style.php');
        require('../../components/notify/notify.php');

        if(isset($_POST['button1'])){
            displayNotify('hello world 12:58pm');
        }
    ?>
<body>
    <?php require('../../components/navbar/navbar.php'); ?>

    <section class="bookList">
        <div class="container">
            <div class="row justify-content-center align-items-center">

                <?php 
                    $con = mysqli_query($sql, "SELECT * FROM `cart` WHERE `userID` = ".$_SESSION['sqlID']);
                    $result = mysqli_num_rows($con);

                    if($result) {
                        while($row = mysqli_fetch_array($con)) {
                            echo '
                                founded
                            ';
                        }
                    } else {
                        echo '
                        <div class="reset text-center">
                            <h1 style="text-align:center; margin-top: 15%;">Hey 😢 <br />There is no books on your shop cart</h1> 
                            <a class="cartLibraryBtn" href="../library/library.php">Library</a>
                        </div>
                        ';
                    }
                ?>

            </div>
        </div>
    </section>

    <?php require('../../components/footer/footer.php'); ?>
</body>
</html>