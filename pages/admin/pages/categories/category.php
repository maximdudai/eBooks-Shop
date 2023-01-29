<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/shop/components/notify/notify.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // ADD NEW CATEGORY
        if(isset($_POST['addNewCategory'])) {
            
            $newCategory = mysqli_real_escape_string($sql, $_POST['newCategoryName']);

            if(strlen($newCategory)) {

                $newcat_query = "SELECT `category_name` FROM `categories` WHERE `category_name` = '$newCategory'";
                $newcat_sendquery = mysqli_query($sql, $newcat_query);

                if(!mysqli_num_rows($newcat_sendquery)) {

                    mysqli_query($sql, "INSERT INTO `categories` (category_name) VALUES ('$newCategory')");
                    displayNotify('New category has been added: '.$newCategory);
                }
                else {
                    echo '
                        <script>alert("This category already exists!");</script>
                    ';
                }
            }            
        }

        if(isset($_POST['addNewSubCategory'])) {

            $subCategoryNameInput = mysqli_real_escape_string($sql, $_POST['subCategoryNameInput']);
            $bookTypeSelected = $_POST['bookTypeSelected'];

            mysqli_query($sql, "INSERT INTO `sub_categories` (sub_category_name, for_category_id) VALUES ('$subCategoryNameInput', '$bookTypeSelected')");
            displayNotify('New Sub Category added: '.$subCategoryNameInput);
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
                        $formatQuery = "SELECT * FROM categories";
                        $executeQuery = mysqli_query($sql, $formatQuery);

                        if(mysqli_num_rows($executeQuery)) {

                            while($row = mysqli_fetch_array($executeQuery)) {

                                echo '
                                    <li class="d-flex justify-content-between align-items-center p-1">
                                        <span>'.$row['category_name'].'</span>
                                        <a id="removeBtn" href="./manage_category/edit_category.php?category_id='.$row['ID'].'">
                                            <span class="material-symbols-outlined">settings</span>
                                        </a>
                                    </li>
                                ';
                            }

                        }
                    ?>
                </ul>
                <form action="category.php" method="post" class="mt-5">
                    <div class="addNewCategory border-bottom text-uppercase"><b>add new category</b></div>
                    <div class="mb-3 mt-2">
                        <input type="text" name="newCategoryName" class="form-control" id="categoryNameInput" aria-describedby="categoryName" placeholder="Category Name.." required>
                    </div>
                    <button name="addNewCategory" type="submit" class="btn btn-primary">Submit</button>
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

                                    $getCategoryInfo = mysqli_query($sql, "SELECT `category_name` FROM `categories` WHERE ID = ".$row['ID']."");
                                    $categoryInfo = mysqli_fetch_assoc($getCategoryInfo);
                                    $categoryName = $categoryInfo['category_name'];

                                    echo '
                                        <tr>
                                            <th scope="row" class="align-items-center">'.$row['sub_category_name'].'</th>
                                            <td>'.$categoryName.'</td>
                                            <td>
                                                <a href="./manage_sub_cat/manage_sub_cat.php?subCatId='.$row['ID'].'">
                                                    <span role="button" tabindex="0" class="material-symbols-outlined">edit_note</span>
                                                </a>
                                            </td>
                                        </tr>
                                    ';
                                }
                            }
                        ?>
                    </tbody>
                </table>

                <form action="category.php" method="post" class="mt-5">
                    <div class="addNewSubCategory border-bottom text-uppercase"><b>add new sub category</b></div>
                    <div class="row m-2 justify-content-between">
                        <div class="col-md-5 mb-3 inputSubCategory">
                            <input type="text" class="form-control" name="subCategoryNameInput" aria-describedby="subCategoryName" placeholder="Sub Category Name.." required>
                        </div>
                        
                        <div class="col-md-5 categoryOption">
                            <select id="bookCategory" name="bookTypeSelected" class="p-2 border" style="cursor:pointer;">
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
                    <button type="submit" name="addNewSubCategory" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>

    <script type="text/javascript" src="./category.script.js"></script>
</body>
</html>