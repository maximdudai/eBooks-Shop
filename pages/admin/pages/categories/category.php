<?php 
    error_reporting(0);
    session_start();

    require('../../../../connection/database.php');
    require_once('../../../../components/notify/notify.php');
?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require('../../../../components/head.php');
        require('./category.style.php');
    ?>
<body>
    
    <?php require('../../../../components/navbar/navbar.php'); ?>

    <div class="container mt-5">

        <div class="row d-flex flex-column justify-content-center align-items-center text-center">

            <div class="col-lg-12">
                <ul class="nav nav-tabs justify-content-center">
                    <li class="nav-item">
                        <a class="menuButton menuCategory nav-link active" aria-current="page" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="menuButton menuSubCategory nav-link" href="#">Sub Categories</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-5 mt-5 addCategory active">
                <ul>
                    <?php
                        $formatQuery = "SELECT category_name FROM categories";
                        $executeQuery = mysqli_query($sql, $formatQuery);

                        if(mysqli_num_rows($executeQuery)) {

                            while($row = mysqli_fetch_array($executeQuery)) {

                                echo '
                                    <li class="d-flex justify-content-between align-items-center p-1">
                                        <span>'.$row['category_name'].'</span>
                                        <span role="button" tabindex="0" class="material-symbols-outlined">delete</span>
                                    </li>
                                ';

                            }

                        }
                    ?>
                </ul>
                <form action="category.php" method="post" class="mt-5">
                    <div class="addNewCategory border-bottom text-uppercase"><b>add new category</b></div>
                    <div class="mb-3 mt-2">
                        <input type="text" class="form-control" id="categoryNameInput" aria-describedby="categoryName" placeholder="Category Name.." required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <div class="col-md-5 mt-5 addSubCategory d-none">
                <!-- ! TODO -->
            </div>
        
        </div>

    </div>

    <?php require('../../../../components/footer/footer.php'); ?>

    <script type="text/javascript" src="./category.script.js"></script>
</body>
</html>