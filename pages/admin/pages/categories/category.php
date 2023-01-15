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

            <div class="col-md-7 mt-5 addSubCategory d-none">

                <table class="table">
                    <thead>
                        <tr class="mb-5">
                            <th scope="col">Sub Category</th>
                            <th scope="col">Category</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $query = "SELECT * FROM `sub_categories` ORDER BY `for_category_id`";
                            $execQuery = mysqli_query($sql, $query);

                            if(mysqli_num_rows($execQuery)) {

                                while($row = mysqli_fetch_array($execQuery)) {
                                    echo '
                                        <tr>
                                            <th scope="row" class="align-items-center">'.$row['sub_category_name'].'</th>
                                            <td>'.$row['for_category_name'].'</td>
                                            <td><span role="button" tabindex="0" class="material-symbols-outlined">edit_note</span></td>
                                        </tr>
                                    ';
                                }

                            }

                        ?>
                    </tbody>
                </table>
                <form action="category.php" method="post" class="mt-5">
                    <div class="addNewSubCategory border-bottom text-uppercase"><b>add new sub category</b></div>
                    <div class="mb-3 mt-2 d-flex flex-row justify-content-between">
                        <div class="inputSubCategory w-100">
                            <input type="text" class="form-control" id="subCategoryNameInput" aria-describedby="subCategoryName" placeholder="Sub Category Name.." required>
                        </div>
                        
                        <div class="categoryOption">
                            <!--  onchange="reloadPageWithCategory();" -->
                            <select id="bookCategory" name="bookTypeSelected" class="p-2">
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
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        
        </div>

    </div>

    <?php require('../../../../components/footer/footer.php'); ?>

    <script type="text/javascript" src="./category.script.js"></script>
</body>
</html>