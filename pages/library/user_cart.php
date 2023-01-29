<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/functions/functions.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/components/notify/notify.php');

    function getUserTotalPrice($sql) {
        $uid = $_SESSION['sqlID'];
        $formatQuery = "SELECT SUM(book_amount * book_price) FROM `user_cart` WHERE `user_id` = $uid";
        $executeQuery = mysqli_query($sql, $formatQuery);

        if(mysqli_num_rows($executeQuery)) {

            while($row = mysqli_fetch_array($executeQuery)) {
                
                $totalPrice = $row['SUM(book_amount * book_price)'];
            }
        }

        return $totalPrice;
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        if(isset($_GET['book_id']) && isset($_GET['book_price']) && isset($_GET['book_name'])) {
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
                    mysqli_query($sql, "INSERT INTO `user_cart` (user_id, book_id, book_amount, book_price) VALUES ('$sql_id', '$book_id', '$book_price')");            
                    displayNotify('Your list updated ✅');
                }
            }
        }


    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
    ?>
<body>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

    <section class="cartBooks justify-content-center">
        <div class="container align-items-center mt-5">
            <div class="row d-flex flex-column justify-content-center align-items-center">
                
                <div class="col-sm-2 text-center">
                    <h3>Your Orders</h3>
                </div>


                <div class="col-lg-7"  style="overflow: auto; max-height: 60vh;">

                    <ul class="m-0 p-0">
                        <?php 

                            $sqlID = $_SESSION['sqlID'];

                            $dbQuery = "SELECT * FROM `user_cart` WHERE `user_id` = $sqlID";
                            $sendQuery = mysqli_query($sql, $dbQuery);


                            if(mysqli_num_rows($sendQuery)) {
                                while($row = mysqli_fetch_array($sendQuery)) {

                                    $getBookInfo = mysqli_query($sql, "SELECT livroName, img_url FROM `stock` WHERE `ID` = ".$row['ID']."");
                                    $bookInfo = mysqli_fetch_assoc($getBookInfo);

                                    $imageContent = displayImageFromDatabase($sql, $row['book_id']);

                                    echo '
                                        <li class="d-flex flex-row justify-content-between align-items-center" 
                                        style="margin: 10px 0;
                                            border: 1px solid; border-radius: 5px;
                                                padding: 15px 10px;"
                                        >

                                           <div class="leftSideContent d-flex flex-row align-items-center">
                                                '.$imageContent.'
                                                <p class="d-flex flex-column">
                                                    <span class="book_title"><b>'.$bookInfo['livroName'].'</b></span>
                                                    <span class="book_amount">Amount: '.$row['book_amount'].'</span>
                                                    <span class="book_price_amount">Total: '.$row['book_amount'] * $row['book_price'].'€</span>
                                                </p>
                                            </div>

                                            <div class="rightSideContent">
                                                <a id="removeBtn" href="./delete_book.php?book_id='.$row['book_id'].'&user_id='.$_SESSION['sqlID'].'">
                                                    <span class="material-symbols-outlined">delete</span>
                                                </a>
                                            </div>
                                        </li>
                                    ';
                                }
                            } else {
                                echo 
                                '
                                    <p class="text-center">
                                        You cart is empty!
                                    </p>
                                ';
                            }

                        ?>
                    </ul>
                </div>

            </div>

            <div class="row text-center mt-3">
                <p style="border-top: 1px solid orange;"> 
                    <b>
                        Total: 
                        <?php echo getUserTotalPrice($sql, $_SESSION['sqlID']); ?>
                        €
                    </b> 
                </p>
            </div>

            <div class="row">
                <div class="buttons text-center d-flex flex-row justify-content-center">
                    <?php
                        if(getUserTotalPrice($sql)) {
                            echo '
                                <a class="btn btn-outline-success m-1" href="./finish_order.php?total_price='.getUserTotalPrice($sql, $_SESSION['sqlID']).'" class="finishOrder">FINISH ORDER</a>
                            ';
                        }
                    ?>
                    <a class="btn btn-outline-warning m-1" href="<?php echo LIBRARY_PAGE; ?>" class="gotoShop">BACK TO SHOPPING</a>
                </div>
            </div>
        </div>
    </section>


    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>

</body>
</html>