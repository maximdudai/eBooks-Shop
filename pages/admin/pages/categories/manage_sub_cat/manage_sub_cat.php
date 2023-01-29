<?php
    error_reporting(0);
    include($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');

    $subCatId = $_GET['subCatId'];
    $subCatQuery = mysqli_query($sql, "SELECT * FROM `sub_categories` WHERE `ID` = '$subCatId'");

    if(!mysqli_num_rows($subCatQuery))
    {
        header("Location: ../category.php");
        die();
    }
    $subCatInfo = mysqli_fetch_assoc($subCatQuery);

    $subCategoryName = $subCatInfo['sub_category_name'];

    $currCategory = mysqli_query($sql, "SELECT * FROM `categories` WHERE `ID` = ".$subCatInfo['for_category_id']."");
    $categoryInfo = mysqli_fetch_assoc($currCategory);
    $categoryName = $categoryInfo['category_name'];
    $forCategoryId = $categoryInfo['ID'];

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finishManageSubCat'])) {

            $newSubCatName = $_POST['newSubCatName'];
            $selectedNewSubCat = $_POST['selectedNewSubCat'];

            mysqli_query($sql, "UPDATE `sub_categories` SET `sub_category_name` = '$newSubCatName', `for_category_id` = '$selectedNewSubCat' WHERE `ID` = '$subCatId'");

            header("Location: ../category.php");
            die();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
    ?>
<body>
    
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

    <div class="container mt-5 justify-content-center w-50">

        <div class="row flex-column align-items-center justify-content-center">
            
            <div class="col-md-5 mb-5 text-center">
                <h3 class="page-title">
                    Manage Sub Categories
                </h3>
            </div>

            <div class="col-md-7">
                <form method="post">
                    <div class="mb-3">
                        <label for="newSubCatName" class="form-label">Sub Category Name</label>
                        <input type="hidden" name="subCatID" value="<?= $subCategory ?>">
                        <input type="text" class="form-control" name="newSubCatName" id="newSubCatName" aria-describedby="newSubCat"
                            value="<?php echo $subCategoryName ?>" required>
                    </div>
                    <div class="mb-3">
                        <div class="col-md">
                            <label for="subCatForCat">
                                <span class="currentCategory">
                                    Current Category:
                                </span>
                                <?= $categoryName ?>
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

                                            echo  '<option value="'.$row['ID'].'"'.$selected.'>'.$row['category_name'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                    </div>
                    <input type="submit" name="finishManageSubCat" value="Submit">
                </form>
            </div>
        </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>
</body>
</html>