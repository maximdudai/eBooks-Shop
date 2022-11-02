<?php error_reporting(E_ERROR | E_PARSE);
    session_start();

    include('../../connection/database.php');
    
    $searchLivro = mysqli_real_escape_string($sql, $_POST['search_book']);

    if(isset($_POST['clearSearch'])) {
        header("Location: library.php");
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

 
    <?php 

        $qry = mysqli_query($sql, !$searchLivro ? "SELECT * FROM `stock` ORDER BY `ID`" : "SELECT * FROM `stock` WHERE lower(`livroName`) like '%$searchLivro%'");
        $result = mysqli_num_rows($qry);
        if($result) {
            while($row = mysqli_fetch_array($qry)) {
                echo '
                    <div class="container text-center">
                    <div class="row m-0">
                        <div class="livro d-flex flex-row p-3 justify-content-between align-items-center">
                            <div class="col-sm-3">
                                <div class="img">
                                    <img src="../../images/livro'.$row['ID'].'.jpg" class="img img-fluid" alt="livro-img">
                                    <p class="p-2 m-0">'.$row['livroName'].'</p>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="book-desc">
                                    <p>
                                        '.$row['livroDescription'].'
                                    </p>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="buttons d-flex flex-column">
                                    <input type="button" value="Add to Cart" class="btn btn-outline-success btn-sm '.(!$_SESSION['loggedIn'] ? ('disabled') : ('')).'">
                                    <button type="submit" class="btn btn-sm btn-fav '.(!$_SESSION['loggedIn'] ? ('disabled') : ('')).'">add to favorites <i class="fa-solid fa-heart-circle-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
            if($searchLivro)
                echo '<form method="post"><input class="resetPage" type="submit" value="reset page" name="clearSearch"></form>';

        }
        else echo '
            <div class="reset text-center">
                <h1 style="text-align:center; margin-top: 15%;">Hey 😢 <br />There is no books with this name<br />Please try again</h1> 
                <form method="post"><input class="resetPage" type="submit" value="reset page" name="clearSearch"></form>
            </div>
        ';


    ?>
    </section>

    <?php require('../../components/footer/footer.php'); ?>

    <script src="./onSearch.js"></script>


</body>
</html>