<?php
    error_reporting(0);

    include('../../../../../connection/database.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        $subCategory = mysqli_real_escape_string($sql, $_GET['sub_cat_id']);
        $subCategoryName = mysqli_real_escape_string($sql, $_GET['sub_cat_name']);
        $forCategoryId = mysqli_real_escape_string($sql, $_GET['for_cat_id']);

        if(isset($_GET['finishManageSubCat'])) {

            echo $_GET['sub_cat_id'];

            // header("Location: ../category.php");
            // die();
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require('../../../../../components/head.php');
    ?>
<body>
    
    <?php require('../../../../../components/navbar/navbar.php'); ?>

    <div class="container mt-5 justify-content-center w-50">

        <div class="row flex-column align-items-center justify-content-center">
            
            <div class="col-md-5 mb-5 text-center">
                <h3 class="page-title">
                    Manage Sub Categories
                </h3>
            </div>

            <div class="col-md-7">
                <form>
                    <div class="mb-3">
                        <label for="newSubCatName" class="form-label">Sub Category Name</label>
                        <input type="text" class="form-control" name="newSubCatName" id="newSubCatName" aria-describedby="newSubCat"
                            value="<?php echo $subCategoryName ?>" required>
                    </div>
                    <div class="mb-3">
                        <div class="col-md">
                            <label for="subCatForCat">
                                <span class="currentCategory">
                                    Current Category:
                                </span>
                                <?php
                                    $categoryName = mysqli_query($sql, "SELECT `category_name` FROM `categories` WHERE `ID` = '$forCategoryId'");

                                    if(mysqli_num_rows($categoryName)) {
                                        while($catName = mysqli_fetch_array($categoryName)) {
                                            echo $catName['category_name'];
                                        }
                                    }
                                ?>
                            </label>
                        </div>
                        
                        <div class="col-md mt-3">
                            <span class="newCategory">
                                New Category:
                            </span>
                            <select id="subCatForCat" name="selectedNewSubCat">
                                <option value="None" disabled selected>Category...</option>
                                <?php
                                    $formatQuery = "SELECT * FROM categories";
                                    $execQuery = mysqli_query($sql, $formatQuery);

                                    if(mysqli_num_rows($execQuery)) {
                                        while($row = mysqli_fetch_array($execQuery)) {
                                            
                                            $selected = ($row['ID'] == $forCategoryId) ? 'selected="selected"' : '';

                                            echo  '<option value="'. $row['ID'] .'"'.$selected.' >'.$row['category_name'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                    </div>
                    <button name="finishManageSubCat" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <?php require('../../../../../components/footer/footer.php'); ?>
</body>
</html>