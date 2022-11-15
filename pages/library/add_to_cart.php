<?php 
    error_reporting(0);

    session_start();

    require('../../connection/database.php');
    require_once('../../components/notify/notify.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        $book_id = mysqli_real_escape_string($sql, trim($_GET['book_id']));
        $book_price = mysqli_real_escape_string($sql, $_GET['book_price']);
        $book_name = mysqli_real_escape_string($sql, $_GET['book_name']);
        
        if(!empty($book_id)) {
            $sql_id = $_SESSION['sqlID'];

            $con = mysqli_query($sql, "SELECT `book_id` FROM `user_cart` WHERE `book_id` = '$book_id' AND `user_id` = '$sql_id'");
            $result = mysqli_num_rows($con);
            if($result)
            {
                header("Location: library.php");
                die();
            } 
            else 
            {
                mysqli_query($sql, "INSERT INTO `user_cart` (user_id, book_id, book_price, book_name) VALUES ('$sql_id', '$book_id', '$book_price', '$book_name')");            
                displayNotify('Your list updated ✅');
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require('../../components/head.php');
        require('./cart.style.php');
    ?>
<body>
    <?php require('../../components/navbar/navbar.php'); ?>


    <section class="cartBooks">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <ul class="list-group w-50">
                    <li class="list-group-item disabled">Your Orders <span class="float-end"><i class="bi bi-cart-check"></i></span></li>

                    <?php
                        $user_id = $_SESSION['sqlID'];

                        $con = mysqli_query($sql, "SELECT * FROM `user_cart` WHERE `user_id` = '$user_id'");
                        $res = mysqli_num_rows($con);
                        
                        $totalPrice = 0;


                        if($res) {
                            while($row = mysqli_fetch_array($con)) {
                                $formatList = '
                                    <li class="list-group-item">
                                        <form method="get">
                                            '.$row['book_name'].' &mdash;
                                            <span>'.strval($row['book_price']).'€</span>
                                            <span class="deleteBtn float-end"><a href="delete_book.php?book_id='.$row['book_id'].'&user_id='.$_SESSION['sqlID'].'"><i class="bi bi-trash3-fill"></i></a></span>
                                        </form>
                                    </li>
                                ';
                                echo $formatList;

                                $totalPrice += $row['book_price'];
                            }
                            $showAmount = '
                                <li class="list-group-item disabled">Total Amount <span class="float-end">'.$totalPrice.'€</span> </li>
                            ';
                            echo $showAmount;

                            $payBtn = '
                                <form method="get">
                                    <button class="finishOrder btn btn-outline-success btn-sm"> <a href="finish_order.php?total_price='.$totalPrice.'">Finish Order</a> </button>
                                </form>
                            ';
                            echo $payBtn;

                        } else {
                            echo ' 
                                <div class="cartBooks text-center">
                                    <h3 class="text-center" style="margin-top: 1%;">You have no books in the cart</h3>
                                </div>
                            ';
                        }
                    ?>
                </ul>
            </div>
            <div class="row">
                <div class="buttons text-center">
                    <br>
                    <a href="./library.php" class="gotoShop">BACK TO SHOPPING</a>
                    <br>
                </div>
            </div>
        </div>
    </section>


    <?php require('../../components/footer/footer.php'); ?>

</body>
</html>