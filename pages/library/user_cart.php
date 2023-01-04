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
                displayNotify('Your list updated ✅');
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
        require('./user_cart.style.php');
    ?>
<body>
    <?php require('../../components/navbar/navbar.php'); ?>


    <section class="cartBooks justify-content-center">
        <div class="container align-items-center mt-5">
            <div class="row d-flex flex-column justify-content-center align-items-center">
                
                <div class="col-sm-2">
                    <h3>Your Orders</h3>
                </div>


                <div class="col-lg-5" 
                     style="overflow: auto; max-height: 60vh;">

                    <ul class="m-0 p-0">
                        <?php 

                            $sqlID = $_SESSION['sqlID'];

                            $dbQuery = "SELECT * FROM `user_cart` WHERE `user_id` = $sqlID";
                            $sendQuery = mysqli_query($sql, $dbQuery);

                            if(mysqli_num_rows($sendQuery)) {

                                while($row = mysqli_fetch_array($sendQuery)) {
                                    echo '
                                        <li class="d-flex flex-row justify-content-between align-items-center" 
                                        style="margin: 10px 0;
                                            border: 1px solid; border-radius: 5px;
                                                padding: 15px 10px;"
                                        >

                                           <div class="leftSideContent d-flex flex-row align-items-center">
                                                <img class"img-thumbnail rounded img-fluid" src="http://localhost/shop/images/livro1.jpg" /> 
                                                <p class="d-flex flex-column">
                                                    <span class="book_title"><b>'.$row['book_name'].'</b></span>
                                                    <span class="book_amount">Amount: '.$row['book_amount'].'</span>
                                                    <span class="book_price_amount">Total: '.$row['book_amount'] * $row['book_price'].'€</span>
                                                </p>
                                            </div>

                                            <div class="rightSideContent">
                                                <a href="#"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </li>
                                    ';
                                }
                            } else {
                                echo '..............';
                            }

                        ?>
                    </ul>

                </div>

            </div>

            <div class="row">
                <div class="buttons text-center d-flex flex-row justify-content-center mt-4">
                    <a class="btn btn-outline-success m-1" href="./finish_order.php" class="finishOrder">FINISH ORDER</a>
                    <a class="btn btn-outline-warning m-1" href="./library.php" class="gotoShop">BACK TO SHOPPING</a>
                </div>
            </div>
        </div>
    </section>


    <?php require('../../components/footer/footer.php'); ?>

</body>
</html>