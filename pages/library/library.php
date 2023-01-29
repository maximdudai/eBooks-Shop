<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/components/notify/notify.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/functions/functions.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/config/constants.php');

    function addItemToCart($sql, $bookid, $price, $bookamount) {

        $user_id = $_SESSION['sqlID'];
        $checkIfAvailable = mysqli_query($sql, "SELECT book_id, book_amount, book_price FROM `user_cart` WHERE `user_id` = $user_id AND `book_id` = $bookid");
        
        if(mysqli_num_rows($checkIfAvailable)) {

            while($row = mysqli_fetch_array($checkIfAvailable)) {
                $newbook_amount = $row['book_amount'] + $bookamount;
                mysqli_query($sql, "UPDATE `user_cart` SET `book_amount` = $newbook_amount WHERE `book_id` = $bookid");
            }

        } else {
            mysqli_query($sql, "INSERT INTO `user_cart` (user_id, book_id, book_price, book_amount) VALUES ('$user_id', '$bookid', '$price', '$bookamount')");
        }

        displayNotify('Your cart has been updated!');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['addToCartButton']))
        {
            $book_id = $_POST['productID'];

            $dbQuery = "SELECT livroPrice FROM `stock` WHERE `ID` = $book_id";
            $dbExecuteQuery = mysqli_query($sql, $dbQuery);

            if(mysqli_num_rows($dbExecuteQuery)) {

                $bookInfo = mysqli_fetch_assoc($dbExecuteQuery);

                $produceAmount = $_POST['productQuantity'];

                addItemToCart($sql, $book_id, $bookInfo['livroPrice'], $produceAmount);
            }
        }
        if(isset($_POST['search_book'])) {
            $searchLivro = mysqli_real_escape_string($sql, $_POST['search_book']);
        }


        if(isset($_POST['submitFilters'])) {
            $filterCategory = $_POST['searchByCategory'];
            $filterSubCategory = $_POST['searchBySubCategory'];
            $searchByPrice = $_POST['searchByPrice'];
            $searchByRanking = $_POST['searchByRanking'];
            
            $filterBy = 'SELECT * FROM `stock`';
        
            if($filterCategory) {
                $filterBy .= "WHERE `livroCategory` = '$filterCategory'";
            }
            if($filterSubCategory) {
                if($$filterCategory) {
                    $filterBy = "AND `livroSubCategory` = ".$filterSubCategory."";
                }
                else {
                    displayNotify('To be able to choose a subcategory, you must first choose a category');
                }
            }
            if($searchByPrice) {
                $orderType = !$searchByPrice ? "DESC" : "ASC";
                $filterBy .= "ORDER BY livroPrice ".$orderType."";
            }
            if($searchByRanking) {
                $rankingType = !$searchByRanking ? "DESC" : "ASC";
                $filterBy .= "ORDER BY totalOrders ".$orderType."";
            }
        }

    }   
?>
<!DOCTYPE html>
<html lang="en">
<?php
    require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/pages/library/library-style.php');
    
?>
<body>
    
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>


    <section class="available-books">
        <div class="search-book d-flex justify-content-center align-items-center">
            <form action="library.php" method="post" class="d-flex mx-auto" style="width: 25rem; margin-top: 1%;" role="search">
                <input class="form-control me-2" id="searchBar" name="search_book" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" id="searchBtn" type="submit">Search</button>
            </form>
        </div>

        <div class="container">
            <div class="row mt-3 border-bottom">
                <form method="POST">
                    <div class="row p-4 justify-content-center">
                        <div class="col-md-7 d-flex flex-row">
                            <div class="col-sm-3">
                                <select class="form-select" aria-label="Default select example" name="searchByCategory">
                                <option selected disabled>Category..</option>
                                <option value="0">Reset..</option>
                                <?php 
                                    $selectCategories = mysqli_query($sql, "SELECT * FROM categories ORDER BY ID");
                                    if(mysqli_num_rows($selectCategories)) {

                                        while($row = mysqli_fetch_array($selectCategories)) {
                                            
                                            echo '<option value="'.$row['ID'].'">'.$row['category_name'].'</option>';
                                        }

                                    }
                                ?>
                                </select>
                            </div>

                            <div class="col-sm-3" style="margin-left: 10px;">
                                <select class="form-select" aria-label="Default select example" name="searchBySubCategory">
                                <option selected disabled>Sub Category..</option>
                                <?php 
                                    $selectCategories = mysqli_query($sql, "SELECT * FROM sub_categories ORDER BY ID");
                                    if(mysqli_num_rows($selectCategories)) {

                                        while($row = mysqli_fetch_array($selectCategories)) {
                                            echo '
                                                <option value="'.$row['ID'].'">'.$row['sub_category_name'].'</option>
                                            ';
                                        }

                                    }
                                ?>
                                </select>
                            </div>

                            <div class="col-sm-3" style="margin-left: 10px;">
                                <select class="form-select" aria-label="Default select example" name="searchByPrice">
                                <option selected disabled>Price..</option>
                                    <option value="0">More expensive</option>
                                    <option value="1">Cheaper</option>
                                </select>
                            </div>

                            <div class="col-sm-3" style="margin-left: 10px;">
                                <select class="form-select" aria-label="Default select example" name="searchByRanking">
                                <option selected disabled>Ranking</option>
                                    <option value="0">Most Purchased</option>
                                    <option value="1">Least Purchased</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid gap-2 col-6 mx-auto mt-3">
                            <button class="btn btn-sm btn-outline-success" type="submit" name="submitFilters">
                                <a href="<?php echo LIBRARY_PAGE."?category=".$filterCategory.""?>">Filter</a>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="text-center p-0">
                <div class="row justify-content-center">
                    <ul class="book-list">
                        <?php

                            $databaseQuery = "SELECT * FROM `stock` ORDER BY `ID`";
                            
                            if($searchLivro) {
                                $databaseQuery = "SELECT * FROM `stock` WHERE lower(`livroName`) like '%$searchLivro%'";
                            } else if($filterBy) {
                                $databaseQuery = $filterBy;
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
                                                                    <input name="productQuantity" class="btn btn-sm btn-outline-success" type="number" value="1" min="1" max="10" />
                                                                    <input type="hidden" name="productID" value="'.$row['ID'].'">
                                                                    <input name="addToCartButton" class="btn btn-sm btn-outline-success" type="submit" id="'.$row['ID'].'" value="Add To Cart" name="addToCart" />
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
                                } else {
                                    echo '
                                        <div class="err-msg mt-5">
                                            <h1>There is no books with this filters 😢</h1>
                                        </div>
                                        <a class="btn btn-outline-success" href="'.LIBRARY_PAGE.'">Reset Filters</a>
                                    ';
                                }
                            ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>

    <script src="./script.js"></script>
</body>
</html>