<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/components/notify/notify.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/functions/functions.php');


    $searchLivro = mysqli_real_escape_string($sql, $_POST['search_book']);
    $bookCategoryID = mysqli_real_escape_string($sql, $_POST['bookTypeSelected']);

    if(isset($_POST['clearSearch'])) {
        header("Location: library.php");
    }

    function addItemToCart($sql, $bookid, $price, $name, $bookamount) {

        $user_id = $_SESSION['sqlID'];


        $checkIfAvailable = mysqli_query($sql, "SELECT book_id, book_amount, book_price FROM `user_cart` WHERE `user_id` = $user_id AND `book_id` = $bookid");
        
        if(mysqli_num_rows($checkIfAvailable)) {

            while($row = mysqli_fetch_array($checkIfAvailable)) {
                $newbook_amount = $row['book_amount'] + $bookamount;
                mysqli_query($sql, "UPDATE `user_cart` SET `book_amount` = $newbook_amount WHERE `book_id` = $bookid");
            }

        } else {
            mysqli_query($sql, "INSERT INTO `user_cart` (user_id, book_id, book_price, book_name, book_amount) VALUES ('$user_id', '$bookid', '$price', '$name', '$bookamount')");
        }

        displayNotify('Your cart has been updated!');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['addToCartButton']))
        {

            $book_id = $_POST['productID'];

            $dbQuery = "SELECT * FROM `stock` WHERE `ID` = $book_id";
            $dbExecuteQuery = mysqli_query($sql, $dbQuery);

            if(mysqli_num_rows($dbExecuteQuery)) {

                $produceAmount = $_POST['productQuantity'];

                while($row = mysqli_fetch_array($dbExecuteQuery)) {

                    addItemToCart($sql, $book_id, $row['livroPrice'], $row['livroName'], $produceAmount);
                }
            }

        }
    }   
?>
<!DOCTYPE html>
<html lang="en">
<?php
    require('../../components/head.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/pages/library/library-style.php');
    
?>
<body>
    
    <?php require('../../components/navbar/navbar.php'); ?>


    <section class="available-books">
        <div class="search-book d-flex justify-content-center align-items-center">
            <form action="library.php" method="post" class="d-flex mx-auto" style="width: 25rem; margin-top: 1%;" role="search">
                <input class="form-control me-2" id="searchBar" name="search_book" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" id="searchBtn" type="submit">Search</button>
            </form>
        </div>

        <div class="search-by-category text-center">

            <div class="bookCategroy">
                <form action="library.php" method="post">
                    <label for="bookCategory">Choose by category:</label>
                    <select id="bookCategory" name="bookTypeSelected" onchange="reloadPageWithCategory();">
                        <option value="None" disabled selected>Select Item..</option>
                        <option value="0">Todos</option>
                        <?php 
                            $sendQuery = mysqli_query($sql, "SELECT * FROM `categories`");
                            $getResult = mysqli_num_rows($sendQuery);

                            if($getResult) 
                            {
                                while($rows = mysqli_fetch_array($sendQuery))
                                {
                                    echo '
                                        <option value="'.$rows['ID'].'">'.$rows['category_name'].'</option>
                                    ';
                                }
                            }
                        ?>
                    </select>
                    <input class="d-none" type="submit" value="" id="submitCategory">
                </form>
            </div>

        </div>

        <div class="container">
            <div class="text-center p-0">
                <div class="row justify-content-center">
                    <ul class="book-list">
                        <?php

                            $databaseQuery = "SELECT * FROM `stock` ORDER BY `ID`";
                            
                            if($searchLivro) {
                                $databaseQuery = "SELECT * FROM `stock` WHERE lower(`livroName`) like '%$searchLivro%'";
                            }
                            if($bookCategoryID) {
                                $databaseQuery = "SELECT * FROM `stock` WHERE `livroCategory` = '$bookCategoryID'";
                            }

                            $bookQuery = mysqli_query($sql, $databaseQuery);
                            $queryResult = mysqli_num_rows($bookQuery);


                            if($queryResult) {
                                while($row = mysqli_fetch_array($bookQuery)) {
                                    echo 
                                    '
                                        <li class="list-element" id='.$row['ID'].'>
                                            <div class="livro d-flex flex-row align-items-center">
                                                <div class="book-image">
                                                    '.displayImageFromDatabase($sql, $row['ID']).'
                                                </div>
                                                <div class="book d-flex flex-column">
                                                    <div class="title__buttons d-flex flex-row justify-content-between">
                                                        <div class="book-title">
                                                            <h3>
                                                                '.$row['livroName'].' &mdash; '.$row['livroPrice'].'$
                                                            </h3>
                                                        </div>
                                                        <div class="book-buttons d-flex flex-row">
                                                            <div class="add-to-cart m-1">
                                                            
                                                                <form method="post" action="library.php?user_cart">
                                                                    <input name="productQuantity" type="number" value="1" min="1" max="10" />
                                                                    <input type="hidden" name="productID" value="'.$row['ID'].'">
                                                                    <input name="addToCartButton" type="submit" id="'.$row['ID'].'" value="Add To Cart" name="addToCart" />
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="description">
                                                            <p>
                                                                '.$row['livroDescription'].'
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <hr />
                                        ';
                                    }
                                    if($searchLivro)
                                        echo '<form method="post"><input class="resetPage" type="submit" value="reset page" name="clearSearch"></form>';
                                } else {
                                    echo '
                                        <h1>Something went wrong 😢</h1>
                                        <p>There is no book with this parameters</p>
                                    ';
                                }
                            ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php require('../../components/footer/footer.php'); ?>

    <script src="./script.js"></script>
</body>
</html>