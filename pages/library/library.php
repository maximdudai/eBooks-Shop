


<!-- 

    getting book id details {name, price, amount}
    save into DB

 -->


<?php error_reporting(0);

    session_start();

    require('../../connection/database.php');
    require_once('../../components/notify/notify.php');

    $searchLivro = mysqli_real_escape_string($sql, $_POST['search_book']);
    $bookCategoryID = mysqli_real_escape_string($sql, $_POST['bookTypeSelected']);

    if(isset($_POST['clearSearch'])) {
        header("Location: library.php");
    }

    function addItemToCart($sql, $bookid, $price, $name, $bookamount) {



        // mysqli_query($sql, "INSERT INTO `user_cart` () VALUES ()");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['addToCart'])) {
            // echo $_POST['bookNumber']; 
            
            $book_id = $_POST['ID'];
            $book_price = $_POST['livroPrice'];
            $book_name = $_POST['livroName'];
            $book_amount = $_POST['bookNumber'];

            addItemToCart($sql, $book_id, $book_price, $book_name, $book_amount);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php
    require('../../components/head.php');
    require('./library-style.php');
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
                        <option value="None" disabled selected>Select...</option>
                        <option value="0">TODOS</option>
                        <option value="1">CULINÁRIA E VINHOS</option>
                        <option value="2">LITERATURA E FICÇÃO</option>
                        <option value="3">INFANTIS E JUVENIS</option>
                        <option value="4">BANDA DESENHADA E MANGA</option>
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
                                                    <img src="../../images/livro1.jpg" alt=".." class="img-fluid book-png" />
                                                </div>

                                                <div class="book d-flex flex-column">

                                                    <div class="title__buttons d-flex flex-row justify-content-between">
                                                        <div class="book-title">
                                                            <h3>
                                                                '.$row['livroName'].' &mdash; '.$row['livroPrice'].'$
                                                            </h3>
                                                        </div>

                                                        <form method="post">
                                                            <div class="book-buttons d-flex flex-row">
                                                                <div class="add-to-cart m-1">
                                                                    <input class="btn btn-outline-warning" type="submit" name="addToCart" value="ADD TO CART" />
                                                                </div>

                                                                <div class="book-numbers m-1">
                                                                    <input type="number" class="btn" id="bookAmount" name="bookNumber" value="1" min="1" max="10" />
                                                                </div>
                                                            </div>
                                                        </form>

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

                                
                            if($searchLivro) {

                            } else {
                                
                                while($row = mysqli_fetch_array($bookQuery)) {
                                    echo 
                                    '

                                    ';
                                }
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