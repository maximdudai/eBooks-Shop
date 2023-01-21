<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/components/notify/notify.php');

    $category_id = mysqli_real_escape_string($sql, $_GET['category_id']);

    if($_SERVER['REQUEST_METHOD']  == 'POST') {

        if(isset($_POST['finishEditCategory'])) {

            $newCategoryName = $_POST['newCategoryName'];
            
            if(strlen($newCategoryName))
            {   
                mysqli_query($sql, "UPDATE `categories` SET `category_name` = '$newCategoryName' WHERE `ID` = '$category_id'");
                header("Location: ../category.php");
                die();
            }
            
        }
        else if(isset($_POST['removeCategory'])) {

            // remove category
            mysqli_query($sql, "DELETE FROM `categories` WHERE `ID` = '$category_id'");

            // remove all sub cateogries available for $category_id
            mysqli_query($sql, "DELETE FROM `sub_categories` WHERE `for_category_id` = '$category_id'");

            header("Location: ../category.php");
            die();
        }
    }

    $category_exist = mysqli_query($sql, "SELECT * FROM `categories` WHERE `ID` = '$category_id'");
    if(!mysqli_num_rows($category_exist)) {
        header("Location: ../category.php");
        die();
    }    

    $category_info = mysqli_fetch_assoc($category_exist);

?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
    ?>
<body>
    
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-7">

                <form action="" method="post">

                    <div class="mb-3">
                        <label for="newCategoryName" class="form-label">Manage Category: <?php echo $category_info['category_name']; ?></label>
                        <input type="text" class="form-control" name="newCategoryName" id="newCategoryName" aria-describedby="newSubCat" placeholder="New Category Name...">
                    </div>
                    <input class="btn btn-outline-success" type="submit" name="finishEditCategory" value="Submit">
                    <input class="btn btn-outline-danger" type="submit" name="removeCategory" value="Remove">
                </form>

            </div>
        </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>
</body>
</html>